<?php

namespace Worldline\Sips\Common\Field;


class PaypageData extends \Worldline\Sips\Common\Field
{
    protected $bypassReceiptPage;

    /**
     * @return bool
     */
    public function getBypassReceiptPage(): bool
    {
        if ($this->bypassReceiptPage == "true") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $bypassReceiptPage
     */
    public function setBypassReceiptPage(bool $bypassReceiptPage)
    {
        if ($bypassReceiptPage) {
            $this->bypassReceiptPage = "true";
        } else {
            $this->bypassReceiptPage = "false";
        }
    }
}
