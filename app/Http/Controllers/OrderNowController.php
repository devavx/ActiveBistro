<?php

namespace App\Http\Controllers;

class OrderNowController extends Controller
{
	public function __construct ()
	{

	}

	public function index ()
	{
		/**
		 * Clear any existing cart sessions, if the user has any.
		 * Reset all preferences in the cart including the profile building
		 * questions we ask such as daily meal count, snacks etc.
		 * And then make sure the user always lands on the 3rd or 4th page
		 * in questions series - skip the trivia.
		 */
		
	}
}