<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	protected $table = 'cw.wt_menu';

	public static function menuBuilder($orderBy = 'parent_id')
	{
		$menuItems = Menu::orderBy($orderBy, 'desc')->get();

		$menu = [];
		$mainMenu = [];
		$subMenus = [];

		foreach($menuItems as $menuItem) {
			$menu['id']         = $menuItem['id'];
			$menu['title']      = $menuItem['title'];
			$menu['url']        = $menuItem['url'];
			$menu['icon']       = $menuItem['icon'];
			$menu['parent_id']  = $menuItem['parent_id'];
			$menu['sort_order'] = $menuItem['sort_order'];
			$menu['visible']    = $menuItem['visible'];
			$menu['submenu']    = [];

			// If Null then this is a Top Level Menu Item
			if (is_null($menu['parent_id'])) {
				// Add Menu Item to $mainMenu

				$id = $menu['id'];
				$mainMenu[$id] = $menu;

			// This is a submenu Item			
			} else {
				// Add to $subMenu['parent_id']
				$id = $menu['parent_id'];

				if (isset($subMenus[$id])) {

					array_push($subMenus[$id], $menu);
				} else {

					$subMenus[$id] = [];
					array_push($subMenus[$id], $menu);
				}
			}
		}

		$mainMenu = Menu::sortArray($mainMenu);

		foreach ($subMenus as $key => &$subMenu) {
			$subMenu = Menu::sortArray($subMenu);

			$mainMenu[$key]['submenu'] = $subMenu;
		}

		return $mainMenu;

	}


	private static function sortArray ($array)
	{
		uasort($array, function($a, $b) {
			if ($a['sort_order'] == $b['sort_order']) return strcmp(strtolower($a['title']), strtolower($b['title']));
			if ($a['sort_order'] == null) return 1;
			if ($b['sort_order'] == null) return -1;
			return ($a['sort_order'] - $b['sort_order']);
		});

		return $array;
	}
}