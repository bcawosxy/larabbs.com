<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
	/**
	 * The application's global HTTP middleware stack.
	 * These middleware are run during every request to your application.
	 * @var array
	 *
	 * 全局中間件，最先調用
	 */
	protected $middleware = [
		// 檢測是否應用是否進入『維護模式』
		// 見：https://d.laravel-china.org/docs/5.5/configuration#maintenance-mode
		\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,

		// 檢測請求的數據是否過大
		\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

		// 對提交的請求參數進行 PHP 函數 trim() 處理
		\App\Http\Middleware\TrimStrings::class,

		// 將提交請求參數中空子串轉換為 null
		\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
	];

	/**
	 * The application's route middleware groups.
	 * @var array
	 *
	 * 定義中間件組
	 */
	protected $middlewareGroups = [
		// Web 中間件組，應用於 routes/web.php 路由文件
		'web' => [
			// Cookie 加密解密
			\App\Http\Middleware\EncryptCookies::class,

			// 將 Cookie 添加到響應中
			\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

			// 開啟會話
			\Illuminate\Session\Middleware\StartSession::class,

			// 認證用戶，此中間件以後 Auth 類才能生效
			// 見：https://d.laravel-china.org/docs/5.5/authentication
			// \Illuminate\Session\Middleware\AuthenticateSession::class,

			// 將系統的錯誤數據注入到視圖變量 $errors 中
			\Illuminate\View\Middleware\ShareErrorsFromSession::class,

			// 檢驗 CSRF ，防止跨站請求偽造的安全威脅
			// 見：https://d.laravel-china.org/docs/5.5/csrf
			\App\Http\Middleware\VerifyCsrfToken::class,

			// 處理路由綁定
			// 見：https://d.laravel-china.org/docs/5.5/routing#route-model-binding
			\Illuminate\Routing\Middleware\SubstituteBindings::class,
		],

		// API 中間件組，應用於 routes/api.php 路由文件
		'api' => [
			// 使用別名來調用中間件
			// 請見：https://d.laravel-china.org/docs/5.5/middleware#為路由分配中間件
			'throttle:60,1',
			'bindings',
		],
	];

	/**
	 * The application's route middleware.
	 * These middleware may be assigned to groups or used individually.
	 * @var array
	 *
	 * 中間件別名設置，允許你使用別名調用中間件，例如上面的 api 中間件組調用
	 */
	protected $routeMiddleware = [
		// 只有登錄用戶才能訪問，我們在控制器的構造方法中大量使用
		'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

		// HTTP Basic Auth 認證
		'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

		// 處理路由綁定
		// 見：https://d.laravel-china.org/docs/5.5/routing#route-model-binding
		'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

		// 用戶授權功能
		'can' => \Illuminate\Auth\Middleware\Authorize::class,

		// 只有遊客才能訪問，在 register 和 login 請求中使用，只有未登錄用戶才能訪問這些頁面
		'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

		// 訪問節流，類似於 『1 分鐘只能請求 10 次』的需求，一般在 API 中使用
		'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
	];
}
