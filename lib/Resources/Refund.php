<?php
/**
 * WARNING: Do not edit by hand, this file was generated by Crank:
 *
 * https://github.com/gocardless/crank
 */

namespace GoCardlessPro\Resources;

/**
 * A thin wrapper around a refund, providing access to its
 * attributes
 *
 * @property-read $amount
 * @property-read $created_at
 * @property-read $currency
 * @property-read $fx
 * @property-read $id
 * @property-read $links
 * @property-read $metadata
 * @property-read $reference
 * @property-read $status
 */
class Refund extends BaseResource
{
    protected $model_name = "Refund";

    /**
     * Amount in minor unit (e.g. pence in GBP, cents in EUR).
     */
    protected $amount;

    /**
     * Fixed [timestamp](#api-usage-time-zones--dates), recording when this
     * resource was created.
     */
    protected $created_at;

    /**
     * [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217#Active_codes) currency
     * code. This is set to the currency of the refund's
     * [payment](#core-endpoints-payments).
     */
    protected $currency;

    /**
     * 
     */
    protected $fx;

    /**
     * Unique identifier, beginning with "RF".
     */
    protected $id;

    /**
     * 
     */
    protected $links;

    /**
     * Key-value store of custom data. Up to 3 keys are permitted, with key
     * names up to 50 characters and values up to 500 characters.
     */
    protected $metadata;

    /**
     * An optional reference that will appear on your customer's bank statement.
     * The character limit for this reference is dependent on the scheme.<br />
     * <strong>ACH</strong> - 10 characters<br /> <strong>Autogiro</strong> - 11
     * characters<br /> <strong>Bacs</strong> - 10 characters<br />
     * <strong>BECS</strong> - 30 characters<br /> <strong>BECS NZ</strong> - 12
     * characters<br /> <strong>Betalingsservice</strong> - 30 characters<br />
     * <strong>PAD</strong> - scheme doesn't offer references<br />
     * <strong>PayTo</strong> - 18 characters<br /> <strong>SEPA</strong> - 140
     * characters<br /> Note that this reference must be unique (for each
     * merchant) for the BECS scheme as it is a scheme requirement. <p
     * class='restricted-notice'><strong>Restricted</strong>: You can only
     * specify a payment reference for Bacs payments (that is, when collecting
     * from the UK) if you're on the <a
     * href='https://gocardless.com/pricing'>GoCardless Plus, Pro or Enterprise
     * packages</a>.</p>
     */
    protected $reference;

    /**
     * One of:
     * <ul>
     * <li>`created`: the refund has been created</li>
     * <li>`pending_submission`: the refund has been created, but not yet
     * submitted to the banks</li>
     * <li>`submitted`: the refund has been submitted to the banks</li>
     * <li>`paid`:  the refund has been included in a
     * [payout](#core-endpoints-payouts)</li>
     * <li>`cancelled`: the refund has been cancelled</li>
     * <li>`bounced`: the refund has failed to be paid</li>
     * <li>`funds_returned`: the refund has had its funds returned</li>
     * </ul>
     */
    protected $status;

}
