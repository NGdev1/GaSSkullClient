<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 03.03.17
 * Time: 7:22
 */

namespace Factory;

use DAO\AdminDao;
use DAO\AdminDaoImpl;
use DAO\CarTypeDao;
use DAO\CarTypeDaoImpl;
use DAO\PriceList\DetailDao;
use DAO\PriceList\DetailDaoImpl;
use DAO\PriceList\PriceListDao;
use DAO\PriceList\PriceListDaoImpl;
use DAO\PriceList\SectionDao;
use DAO\PriceList\SectionDaoImpl;
use DAO\PriceList\WorkDao;
use DAO\PriceList\WorkDaoImpl;
use DAO\UserDao;
use DAO\UserDaoImpl;
use Services\AdminService;
use Services\AdminServiceImpl;

class Factory
{
    /**
     * @return AdminService
     */
    static function getAdminService(){
        return AdminServiceImpl::getInstance();
    }

    /**
     * @return AdminDao
     */
    static function getAdminDao(){
        return AdminDaoImpl::getInstance();
    }

    /**
     * @return PriceListDao
     */
    static function getPriceListDao(){
        return PriceListDaoImpl::getInstance();
    }

    /**
     * @return WorkDao
     */
    static function getWorkDao(){
        return WorkDaoImpl::getInstance();
    }

    /**
     * @return SectionDao
     */
    static function getSectionDao(){
        return SectionDaoImpl::getInstance();
    }

    /**
     * @return DetailDao
     */
    static function getDetailDao(){
        return DetailDaoImpl::getInstance();
    }

    /**
     * @return CarTypeDao
     */
    static function getCarTypeDao(){
        return CarTypeDaoImpl::getInstance();
    }

    /**
     * @return UserDao
     */
    static function getUserDao(){
        return UserDaoImpl::getInstance();
    }
}