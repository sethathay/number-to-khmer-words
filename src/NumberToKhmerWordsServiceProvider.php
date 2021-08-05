<?php

namespace SethaThay\NumberToKhmerWords;

use Illuminate\Support\ServiceProvider;

class NumberToKhmerWordsServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
    $this->app->bind('numbertokhmerwords', function($app) {
        return new NumberToKhmerWords();
    });
  }

  public function boot()
  {
    //
  }
}
