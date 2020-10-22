<?php

namespace App\Http\Controllers\Admin;

use App\Core\Enums\Common\DaysOfWeek;
use App\Core\Utils\CellNavigator;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
	public function __construct ()
	{

	}

	public function index (): Renderable
	{
		$orderCollection = Order::query()->latest()->get();
		return view('backend.admin.orders.index')->with('orders', $orderCollection);
	}

	public function show ($key)
	{
		/**
		 * @var Order $order
		 */
		$order = Order::query()->with('user', 'items', 'address', 'secondAddress', 'items.meal')->whereKey($key)->first();
		if ($order != null) {
			return response()->json(['success' => 1, 'message' => '', 'data' => view('backend.admin.orders.show')->with('order', $order)->render()]);
		} else {
			return response()->json(['success' => 0, 'message' => '', 'data' => null]);
		}
	}

	public function delete ($key)
	{
		$order = Order::query()->whereKey($key)->first();
		$order->items()->delete();
		$order->delete();
		if ($order != null) {
			return response()->json([
				'status' => 'success',
				'message' => 'Order deleted successfully!'
			]);
		} else {
			return response()->json([
				'status' => 'error',
				'message' => 'Something went wrong!'
			]);
		}
	}

	public function deleteBulk ()
	{
		$result = array();
		$result['success'] = 1;
		$result['message'] = 'Order(s) deleted successfully!';
		$result['data'] = [];
		Order::query()->whereIn('id', request('orders', []))->each(function (Order $order) {
			$order->items()->delete();
			$order->delete();
		});
		return response()->json($result);
	}

	public function updateStatus ($key, $status)
	{
		/**
		 * @var Order $order
		 */
		$order = Order::query()->whereKey($key)->first();
		if ($order != null) {
			$order->update(['status' => $status]);
			return response()->json(['success' => 1, 'message' => 'Updated order status successfully!', 'data' => null]);
		} else {
			return response()->json(['success' => 0, 'message' => 'Could not find order with that key.', 'data' => null]);
		}
	}

	public function export ()
	{
		$header = [
			'OrderId',
			'Customer',
			'Total',
			'Placed',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday',
			'Sunday',
		];
		$keys = request('key', []);
		$orderCollection = Order::query()->with('items')->get();
		$orderCollection->transform(function (Order $order) {
			$payload = [
				'orderId' => '#' . $order->invoice_id,
				'customer' => $order->user->name ?? 'N/A',
				'total' => $order->total,
				'placed' => date('d M g:i A', strtotime($order->created_at))
			];
			foreach (DaysOfWeek::sequence() as $value) {
				$payload[] = $order->items->where('day', $value)->transform(function (OrderItem $orderItem) {
					return sprintf("%s [%s,%s,%s]", $orderItem->meal->name, $orderItem->items[0]->name, $orderItem->items[1]->name, $orderItem->items[2]->name);
				})->toArray();
			}
			return $payload;
		});
		$navigator = new CellNavigator();
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->fromArray($header, null, $navigator->currentCell());
		$navigator->advanceNextRow();
		$orderCollection->each(function (array $order) use (&$sheet, &$navigator) {
			$sheet->fromArray($order, null, $navigator->currentCell());
			$navigator->advanceNextRow();
		});
		$writer = new Xlsx($spreadsheet);
		$response = new StreamedResponse(
			function () use ($writer) {
				$writer->save('php://output');
			}
		);
		$response->headers->set('Content-Type', 'application/vnd.ms-excel');
		$response->headers->set('Content-Disposition', sprintf('attachment;filename="Orders_%s.xls"', Carbon::now()->timestamp));
		$response->headers->set('Cache-Control', 'max-age=0');
		return $response;
	}
}