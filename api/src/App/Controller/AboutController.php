<?php
/*
 * Copyright ©  2023 Luyanda Siko <sikoluyanda@gmail.com>
 *
 * License: https://opensource.org/licenses/BSD-3-Clause
 */

declare(strict_types=1);

namespace CoolStuff\App\Controller;

use CoolStuff\Version;
use Laminas\Diactoros\Response;

/**
 * Class AboutController.
 *
 * @package CoolStuff\App\Controller
 * @author Luyanda Siko <sikoluyanda@gmail.com>
 */
class AboutController extends Controller
{
    /** @inheritDoc */
    public function indexAction(): Response
    {
        return $this->response([
            'description' => 'CoolStuff API (v' . Version::NUMBER . ')',
        ]);
    }
}
