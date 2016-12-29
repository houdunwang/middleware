<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\middleware;

use houdunwang\framework\build\Provider;

class MiddlewareProvider extends Provider {
	//延迟加载
	public $defer = true;
	protected $middleware = [ 'hdphp\middleware\App', 'hdphp\middleware\Csrf' ];

	public function boot() {
		//添加全局中间件
		$config = array_merge( c( 'middleware.global' ), $this->middleware );
		c( 'middleware.global', array_unique( $config ) );
		//执行全局中间件
		\Middleware::globals();
	}

	public function register() {
		$this->app->single( 'Middleware', function ( $app ) {
			return Middleware::single( $app );
		} );
	}


}