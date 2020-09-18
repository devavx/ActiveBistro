<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $fillable = ['code', 'description', 'valid_from', 'valid_until', 'active', 'usage_count', 'discount', 'type', 'promote'];
	protected $casts = ['active' => 'bool', 'promoted' => 'bool'];
	public const Flat = 'flat';
	public const Percent = 'percent';

	public function promoteScope (Builder $query): Builder
	{
		return $query->where('promote', true);
	}

	public function isValid (): bool
	{
		$begin = strtotime($this->valid_from . '00:00:00');
		$end = strtotime($this->valid_until . '00:00:00');
		$current = time();
		return $current > $begin && $current <= $end;
	}

	public function isUsable (): bool
	{
		return (empty($this->usage_limit)) || (!empty($this->usage_limit) && $this->usage_limit > 0);
	}

	public function incrementUsageCount (): int
	{
		if (!empty($this->usage_limit))
			return $this->increment('usage_limit');
		else
			return 0;
	}
}