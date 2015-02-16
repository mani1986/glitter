<?php
namespace Glitter\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class Controller
 *
 * @package Glitter\Http\Controllers
 */
abstract class Controller extends BaseController
{
	use DispatchesCommands, ValidatesRequests;

}
