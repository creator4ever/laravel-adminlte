<?php namespace GionniValeriana\laravelAdminlte;

use AdminAuth;
use App;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Router;

class AssetManager
{
	/**
	 * Styles array to include on every admin page
	 * @var array
	 */
	protected static $styles = ['admin::all.min.css'];
	/**
	 * Scripts array to include on every admin page
	 * @var array
	 */
	protected static $scripts = ['/packages/almasaeed2010/adminlte/plugins/jQuery/jQuery-2.1.3.min.js', 'http://code.jquery.com/ui/1.11.2/jquery-ui.min.js', 'admin::all.custom.js'];

	public static function styles()
	{
		return static::assets(static::$styles);
	}

	public static function addStyle($style)
	{
		static::$styles[] = $style;
	}

	public static function scripts()
	{
		$scripts = static::assets(static::$scripts);
		array_unshift($scripts, Admin::instance()->router->routeToLang(App::getLocale()));
		return $scripts;
	}

	public static function addScript($script)
	{
		static::$scripts[] = $script;
	}

	/**
	 * @param $assets
	 * @return array
	 */
	protected static function assets($assets)
	{
		return array_map(function ($asset)
		{
			if (strpos($asset, 'admin::') !== false)
			{
				$asset = str_replace('admin::', '', $asset);
				return Admin::instance()->router->routeToAsset($asset);
			}
			return $asset;
		}, array_unique($assets));
	}
} 