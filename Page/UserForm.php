<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

trait UserForm
{
    // include form fields of current page
    public static $userLoginNameField = ['id' => 'userLoginName'];
    public static $userPasswordField = ['id' => 'userPassword'];
    public static $userPasswordConfirmField = ['id' => 'userPasswordConfirm'];

    //user data
    public static $userUstIDField = 'invadr[oxuser__oxustid]';
    public static $userMobFonField = 'invadr[oxuser__oxmobfon]';
    public static $userPrivateFonField = 'invadr[oxuser__oxprivfon]';
    public static $userBirthDateDayField = 'invadr[oxuser__oxbirthdate][day]';
    public static $userBirthDateMonthField = "invadr[oxuser__oxbirthdate][month]";
    public static $userBirthDateYearField = 'invadr[oxuser__oxbirthdate][year]';

    //user address data
    public static $billUserSalutation = '#invadr_oxuser__oxfname';
    public static $billUserFirstName = 'invadr[oxuser__oxfname]';
    public static $billUserLastName = 'invadr[oxuser__oxlname]';
    public static $billCompanyName = 'invadr[oxuser__oxcompany]';
    public static $billStreetNr = 'invadr[oxuser__oxstreetnr]';
    public static $billStreet = 'invadr[oxuser__oxstreet]';
    public static $billZIP = 'invadr[oxuser__oxzip]';
    public static $billCity = 'invadr[oxuser__oxcity]';
    public static $billAdditionalInfo = 'invadr[oxuser__oxaddinfo]';
    public static $billFonNr = 'invadr[oxuser__oxfon]';
    public static $billFaxNr = 'invadr[oxuser__oxfax]';
    public static $billCountryId = "#invCountrySelect";
    public static $billStateId = "#oxStateSelect_invadr[oxuser__oxstateid]";

    //user delivery address data
    public static $delUserSalutation = '#deladr_oxaddress__oxsal';
    public static $delUserFirstName = 'deladr[oxaddress__oxfname]';
    public static $delUserLastName = 'deladr[oxaddress__oxlname]';
    public static $delCompanyName = 'deladr[oxaddress__oxcompany]';
    public static $delStreetNr = 'deladr[oxaddress__oxstreetnr]';
    public static $delStreet = 'deladr[oxaddress__oxstreet]';
    public static $delZIP = 'deladr[oxaddress__oxzip]';
    public static $delCity = 'deladr[oxaddress__oxcity]';
    public static $delAdditionalInfo = 'deladr[oxaddress__oxaddinfo]';
    public static $delFonNr = 'deladr[oxaddress__oxfon]';
    public static $delFaxNr = 'deladr[oxaddress__oxfax]';
    public static $delCountryId = "#delCountrySelect";
    public static $delStateId = "#oxStateSelect_deladr[oxaddress__oxstateid]";

    /**
     * @param string $userLoginName
     *
     * @return $this
     */
    public function enterUserLoginName($userLoginName)
    {
        $I = $this->user;
        $I->fillField(self::$userLoginNameField, $userLoginName);
        return $this;
    }

    /**
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserLoginData($userData)
    {
        $I = $this->user;
        $I->fillField(self::$userLoginNameField, $userData['userLoginNameField']);
        $I->fillField(self::$userPasswordField, $userData['userPasswordField']);
        $I->fillField(self::$userPasswordConfirmField, $userData['userPasswordField']);
        return $this;
    }

    /**
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserData($userData)
    {
        $I = $this->user;
        $I->fillField(self::$userUstIDField, $userData['userUstIDField']);
        $I->fillField(self::$userMobFonField, $userData['userMobFonField']);
        $I->fillField(self::$userPrivateFonField, $userData['userPrivateFonField']);

        $I->fillField(self::$userBirthDateDayField, $userData['userBirthDateDayField']);
        $I->fillField(self::$userBirthDateYearField, $userData['userBirthDateYearField']);

        $I->selectOption(self::$userBirthDateMonthField, $userData['userBirthDateMonthField']);
        return $this;
    }

    /**
     * @param array $userData
     *
     * @return $this
     */
    public function enterAddressData($userData)
    {
        $I = $this->user;
        $I->selectOption(self::$billUserSalutation, $userData['UserSalutation']);
        unset($userData['UserSalutation']);
        $this->selectBillingCountry($userData['CountryId']);
        unset($userData['CountryId']);
        if (isset($userData['StateId'])) {
            $I->selectOption(self::$billStateId, $userData['StateId']);
            unset($userData['StateId']);
        }

        foreach ($userData as $key => $value) {
            $locatorName = 'bill'.$key;
            $I->fillField(self::${$locatorName}, $value);
        }
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectBillingCountry($country)
    {
        $I = $this->user;
        $I->selectOption(self::$billCountryId, $country);
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectShippingCountry($country)
    {
        $I = $this->user;
        $I->selectOption(self::$delCountryId, $country);
        return $this;
    }

    /**
     * @param array $userData
     *
     * @return $this
     */
    public function enterShippingAddressData($userData)
    {
        $I = $this->user;
        $I->selectOption(self::$delUserSalutation, $userData['UserSalutation']);
        unset($userData['UserSalutation']);
        $this->selectShippingCountry($userData['CountryId']);
        unset($userData['CountryId']);
        if (isset($userData['StateId'])) {
            $I->selectOption(self::$delStateId, $userData['StateId']);
            unset($userData['StateId']);
        }

        foreach ($userData as $key => $value) {
            $locatorName = 'del'.$key;
            $I->fillField(self::${$locatorName}, $value);
        }
        return $this;
    }
}
