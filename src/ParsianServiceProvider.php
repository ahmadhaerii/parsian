<?php
/**
 * Created by PhpStorm.
 * User: ahmd
 * Date: 11/7/2019
 * Time: 9:23 AM
 */
namespace appsfarsi\parsian;

use Illuminate\Support\ServiceProvider;


class ParsianServiceProvider extends ServiceProvider {

  /**
   * Boot the service provider.
   *
   * @return null
   */
  public function boot()
  {
    // Publish configuration files
    $this->publishes([
      __DIR__.'/../config/Parsian.php' => config_path('Parsian.php')
    ], 'config');


  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {

  }

}