<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Page;

class PaymentCheckout extends Page
{
    // include url of current page
    public static $URL = '';

    public static $paymentMethod = '';

    //save form button
    public static $nextStepButton = '#paymentNextStepBottom';

    public static $previousStepButton = '.prevStep';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @param $paymentMethod
     *
     * @return $this
     */
    public function selectPayment($paymentMethod)
    {
        $I = $this->user;
        $I->click('#payment_'.$paymentMethod);
        return $this;
    }

    /**
     * @return OrderCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click(self::$nextStepButton);
        $I->waitForElement(self::$breadCrumb);
        return new OrderCheckout($I);
    }

    /**
     * @return UserCheckout
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click(self::$previousStepButton);
        $I->waitForElement(self::$breadCrumb);
        return new UserCheckout($I);
    }
}
