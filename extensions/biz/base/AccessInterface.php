<?php
namespace biz\base;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mdmunirdeb
 */
interface AccessInterface
{
    public function check($user,$action,$model);
}