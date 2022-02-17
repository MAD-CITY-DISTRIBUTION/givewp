<?php

namespace Give\PaymentGateways\Gateways\Stripe\Actions;

use Give\PaymentGateways\DataTransferObjects\GatewayPaymentData;
use Give\PaymentGateways\Gateways\Stripe\Exceptions\StripeCustomerException;
use Give\PaymentGateways\Gateways\Stripe\ValueObjects\PaymentMethod;
use Give\PaymentGateways\Gateways\Stripe\WorkflowAction;
use Give_Stripe_Customer;

class GetOrCreateStripeCustomer extends WorkflowAction
{

    /**
     * @unreleased
     *
     * @throws StripeCustomerException
     */
    public function __invoke(GatewayPaymentData $paymentData)
    {
        $giveStripeCustomer = new Give_Stripe_Customer($paymentData->donorInfo->email);

        if (!$giveStripeCustomer->get_id()) {
            throw new StripeCustomerException(__('Unable to find or create stripe customer object.', 'give'));
        }

        $this->saveStripeCustomerId($paymentData->donationId, $giveStripeCustomer->get_id());

        $this->bind( $giveStripeCustomer );
    }

    /**
     * @unreleased
     *
     * @param  int  $donationId
     * @param  string  $stripeCustomerId
     * @return void
     */
    protected function saveStripeCustomerId($donationId, $stripeCustomerId)
    {
        $donor = new \Give_Donor(
            give_get_payment_donor_id($donationId)
        );

        $donor->update_meta(give_stripe_get_customer_key(), $stripeCustomerId);

        give_insert_payment_note(
            $donationId,
            sprintf(__('Stripe Customer ID: %s', 'give'), $stripeCustomerId)
        );
        
        give_update_meta($donationId, give_stripe_get_customer_key(), $stripeCustomerId);
    }
}
