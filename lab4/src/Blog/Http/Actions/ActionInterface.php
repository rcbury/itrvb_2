<?php

namespace lab3\Blog\Http\Actions;

use lab3\Blog\Http\Request;
use lab3\Blog\Http\Response;

interface ActionInterface
{
	public function handle(Request $request): Response;
}