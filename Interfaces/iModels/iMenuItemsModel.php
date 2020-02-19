<?php

namespace webshop_v2\Interfaces\iModels;

Interface iMenuItemsModel
{
    public function getMenuItems(int $logged_status);
}