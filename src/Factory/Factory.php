<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:22
 */

namespace Factory;


use DAO\CarTypeDaoImpl;
use DAO\PriceList\DetailDaoImpl;
use DAO\PriceList\PriceListDaoImpl;
use DAO\PriceList\SectionDaoImpl;
use DAO\PriceList\WorkDaoImpl;
use DAO\UserDaoImpl;

class Factory
{
    /**
     * @return PriceListDaoImpl
     */
    static function getPriceListDao(){
        return PriceListDaoImpl::getInstance();
    }

    /**
     * @return WorkDaoImpl
     */
    static function getWorkDao(){
        return WorkDaoImpl::getInstance();
    }

    /**
     * @return SectionDaoImpl
     */
    static function getSectionDao(){
        return SectionDaoImpl::getInstance();
    }

    /**
     * @return DetailDaoImpl
     */
    static function getDetailDao(){
        return DetailDaoImpl::getInstance();
    }

    /**
     * @return CarTypeDaoImpl
     */
    static function getCarTypeDao(){
        return CarTypeDaoImpl::getInstance();
    }

    /**
     * @return UserDaoImpl
     */
    static function getUserDao(){
        return UserDaoImpl::getInstance();
    }
}