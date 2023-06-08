<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * コンポーネントインスタンスを作成
     */
    public function __construct(
        public string $type,
        public string $session,
    ) {}

    /**
     * コンポーネントを表すビュー／コンテンツを取得
     */
    public function render(): View
    {
        return view('components.alert');
    }
}
