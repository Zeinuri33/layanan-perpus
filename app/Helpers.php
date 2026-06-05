<?php

function hasPermission($permissions)
{
    if (!auth()->check()) return false;

    try {
        if (is_array($permissions)) {
            foreach ($permissions as $perm) {
                if (auth()->user()->hasPermissionTo($perm)) {
                    return true;
                }
            }
            return false;
        }

        return auth()->user()->hasPermissionTo($permissions);

    } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist $e) {
        return false;
    }
}

function isActive($routes)
{
    $routes = (array) $routes;

    foreach ($routes as $route) {
        $url = request()->fullUrl();
        $currentPath = request()->path();
        $currentQuery = request()->query();

        // Pisahkan path & query dari route
        $parsed = parse_url($route);
        $routePath = ltrim($parsed['path'], '/');
        $routeQuery = [];

        if (isset($parsed['query'])) {
            parse_str($parsed['query'], $routeQuery);
        }

        // Cek path sama
        if ($currentPath === $routePath) {

            // Kalau tidak ada query → langsung aktif
            if (empty($routeQuery)) {
                return true;
            }

            // Cek query cocok
            if ($routeQuery == array_intersect_key($currentQuery, $routeQuery)) {
                return true;
            }
        }
    }

    return false;
}

function renderMenu($items)
{
    foreach ($items as $item) {
        if (!hasPermission($item['permission'])) continue;

        $active = isActive($item['route']) ? 'active' : '';
        $route = is_array($item['route']) ? $item['route'][0] : $item['route'];

        echo '<div class="menu-item">';
        echo '<a href="/' . $route . '" class="menu-link ' . $active . '">';
        echo '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>';
        echo '<span class="menu-title">' . $item['title'] . '</span>';
        echo '</a>';
        echo '</div>';
    }
}

function renderMenuWithSub($items)
{
    foreach ($items as $item) {
        if (!hasPermission($item['permission'])) continue;

        $isActiveParent = isActive($item['route']);
        $hasSub = !empty($item['sub']);

        if ($hasSub) {
            echo '<div data-kt-menu-trigger="click" class="menu-item menu-accordion ' . ($isActiveParent ? 'here show' : '') . '">';
            $icon = $item['icon'] ?? 'ki-outline ki-folder';

            echo '<span class="menu-link">';
            echo '<span class="menu-icon"><i class="' . $icon . ' fs-2"></i></span>';
            echo '<span class="menu-title">' . $item['title'] . '</span>';
            echo '<span class="menu-arrow"></span>';
            echo '</span>';

            echo '<div class="menu-sub menu-sub-accordion">';
            foreach ($item['sub'] as $sub) {
                if (!hasPermission($sub['permission'])) continue;

                $isActiveSub = isActive($sub['route']);
                $subRoute = is_array($sub['route']) ? $sub['route'][0] : $sub['route'];

                echo '<div class="menu-item">';
                echo '<a href="/' . $subRoute . '" class="menu-link ' . ($isActiveSub ? 'active' : '') . '">';
                echo '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>';
                echo '<span class="menu-title">' . $sub['title'] . '</span>';
                echo '</a>';
                echo '</div>';
            }
            echo '</div>';

            echo '</div>';
        }
    }
}