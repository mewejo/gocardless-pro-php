<?php

namespace GoCardless;

/**
  * Main GoCardless Client class, when created it allows access to the API.
  */
class Client
{
    /** @var Core/HttpClient Internal reference to HTTP Client object */
    private $http_client;
    
    /**
     * Constructor returning a new \GoCardless\Client class.
     * @param array[string]string $options Options (required: api_secret, api_key, optional: environment).
     */
    public function __construct($options)
    {
        $req_options = array();
        if (!isset($options['environment'])) {
            $options['environment'] = Environment::PRODUCTION;
        }
        foreach (array('api_key', 'api_secret', 'environment') as $req_option) {
            if (!isset($options[$req_option])) {
                throw new \Exception('Missing required option `' . $req_option . '`.');
            }
            if (!is_string($options[$req_option])) {
                throw new \Exception('Option `'. $req_option .'` can only be a string.');
            }
            $req_options[$req_option] = $options[$req_option];
            unset($options[$req_option]);
        }
        if (!empty($options)) {
            throw new \Exception('Unexpected options passed in: ' . implode(', ', array_keys($options)));
        }
        $this->http_client = new Core\HttpClient(
            $req_options['api_key'],
            $req_options['api_secret'],
            $req_options['environment'],
            $options
        );
    }


  /**
    * API Keys
    *
    * <a name="api_key_not_active"></a>API keys are designed to be used by any
    * integrations you build. You should generate a key and then use it to make
    * requests to the API and set the webhook URL for that integration. They do
    * not expire, but can be disabled.
    *
    * @return Services\ApiKey
    */
    public function api_keys()
    {
        if (!isset($this->api_keys)) {
            $this->api_keys = new Services\ApiKey($this->http_client);
        }
        return $this->api_keys;
    }

  /**
    * Creditors
    *
    * Each
    * [payment](https://developer.gocardless.com/pro/#api-endpoints-payments)
    * taken through the API is linked to a "creditor", to whom the payment is
    * then paid out. In most cases your organisation will have a single
    * "creditor", but the API also supports collecting payments on behalf of
    * others.
    * 
    * Please get in touch if you wish to use this endpoint.
    * Currently, for Anti Money Laundering reasons, any creditors you add must
    * be directly related to your organisation.
    *
    * @return Services\Creditor
    */
    public function creditors()
    {
        if (!isset($this->creditors)) {
            $this->creditors = new Services\Creditor($this->http_client);
        }
        return $this->creditors;
    }

  /**
    * Creditor Bank Accounts
    *
    * Creditor Bank Accounts hold the bank details of a
    * [creditor](https://developer.gocardless.com/pro/#api-endpoints-creditor).
    * These are the bank accounts which your
    * [payouts](https://developer.gocardless.com/pro/#api-endpoints-payouts)
    * will be sent to.
    * 
    * Note that creditor bank accounts must be
    * unique, and so you will encounter a `bank_account_exists` error if you try
    * to create a duplicate bank account. You may wish to handle this by
    * updating the existing record instead, the ID of which will be provided as
    * `links[creditor_bank_account]` in the error response.
    *
    * @return Services\CreditorBankAccount
    */
    public function creditor_bank_accounts()
    {
        if (!isset($this->creditor_bank_accounts)) {
            $this->creditor_bank_accounts = new Services\CreditorBankAccount($this->http_client);
        }
        return $this->creditor_bank_accounts;
    }

  /**
    * Customers
    *
    * Customer objects hold the contact details for a customer. A customer can
    * have several [customer bank
    * accounts](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-accounts),
    * which in turn can have several Direct Debit
    * [mandates](https://developer.gocardless.com/pro/#api-endpoints-mandates).
    *
    * @return Services\Customer
    */
    public function customers()
    {
        if (!isset($this->customers)) {
            $this->customers = new Services\Customer($this->http_client);
        }
        return $this->customers;
    }

  /**
    * Customer Bank Accounts
    *
    * Customer Bank Accounts hold the bank details of a
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers).
    * They always belong to a
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers),
    * and may be linked to several Direct Debit
    * [mandates](https://developer.gocardless.com/pro/#api-endpoints-mandates).

    *    * 
    * Note that customer bank accounts must be unique, and so you
    * will encounter a `bank_account_exists` error if you try to create a
    * duplicate bank account. You may wish to handle this by updating the
    * existing record instead, the ID of which will be provided as
    * links[customer_bank_account] in the error response.
    *
    * @return Services\CustomerBankAccount
    */
    public function customer_bank_accounts()
    {
        if (!isset($this->customer_bank_accounts)) {
            $this->customer_bank_accounts = new Services\CustomerBankAccount($this->http_client);
        }
        return $this->customer_bank_accounts;
    }

  /**
    * Events
    *
    * Events are stored for all webhooks. An event refers to a resource which
    * has been updated, for example a payment which has been collected, or a
    * mandate which has been transferred.
    *
    * @return Services\Event
    */
    public function events()
    {
        if (!isset($this->events)) {
            $this->events = new Services\Event($this->http_client);
        }
        return $this->events;
    }

  /**
    * Helpers
    *
    * @return Services\Helper
    */
    public function helpers()
    {
        if (!isset($this->helpers)) {
            $this->helpers = new Services\Helper($this->http_client);
        }
        return $this->helpers;
    }

  /**
    * Mandates
    *
    * Mandates represent the Direct Debit mandate with a
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers).

    *    * 
    * GoCardless will notify you via a
    * [webhook](https://developer.gocardless.com/pro/#webhooks) whenever the
    * status of a mandate changes.
    *
    * @return Services\Mandate
    */
    public function mandates()
    {
        if (!isset($this->mandates)) {
            $this->mandates = new Services\Mandate($this->http_client);
        }
        return $this->mandates;
    }

  /**
    * Payments
    *
    * Payment objects represent payments from a
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers)
    * to a
    * [creditor](https://developer.gocardless.com/pro/#api-endpoints-creditors),
    * taken against a Direct Debit
    * [mandate](https://developer.gocardless.com/pro/#api-endpoints-mandates).
 
    *   * 
    * GoCardless will notify you via a
    * [webhook](https://developer.gocardless.com/pro/#webhooks) whenever the
    * state of a payment changes.
    *
    * @return Services\Payment
    */
    public function payments()
    {
        if (!isset($this->payments)) {
            $this->payments = new Services\Payment($this->http_client);
        }
        return $this->payments;
    }

  /**
    * Payouts
    *
    * Payouts represent transfers from GoCardless to a
    * [creditor](https://developer.gocardless.com/pro/#api-endpoints-creditors).
    * Each payout contains the funds collected from one or many
    * [payments](https://developer.gocardless.com/pro/#api-endpoints-payments).
    * Payouts are created automatically after a payment has been successfully
    * collected.
    *
    * @return Services\Payout
    */
    public function payouts()
    {
        if (!isset($this->payouts)) {
            $this->payouts = new Services\Payout($this->http_client);
        }
        return $this->payouts;
    }

  /**
    * Publishable API Keys
    *
    * Publishable API keys are designed to be used by the [js
    * flow](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-account-tokens).
    * You should generate a key and then use it to make requests to the API.
    * They do not expire, but can be disabled.
    * 
    * Publishable API keys
    * only have permissions to create [customer bank account
    * tokens](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-account-tokens).
    *
    * @return Services\PublishableApiKey
    */
    public function publishable_api_keys()
    {
        if (!isset($this->publishable_api_keys)) {
            $this->publishable_api_keys = new Services\PublishableApiKey($this->http_client);
        }
        return $this->publishable_api_keys;
    }

  /**
    * Redirect Flows
    *
    * Redirect flows enable you to use GoCardless Pro's secure payment pages to
    * set up mandates with your customers.
    * 
    * The overall flow is:
   
    * * 
    * 1. You
    * [create](https://developer.gocardless.com/pro/#create-a-redirect-flow) a
    * redirect flow for your customer, and redirect them to the returned
    * redirect url, e.g. `https://pay.gocardless.com/flow/RE123`.
    * 
    *
    * 2. Your customer supplies their name, email, address, and bank account
    * details, and submits the form. This securely stores their details, and
    * redirects them back to your `success_redirect_url` with
    * `redirect_flow_id=RE123` in the querystring.
    * 
    * 3. You
    * [complete](https://developer.gocardless.com/pro/#complete-a-redirect-flow)
    * the redirect flow, which creates a
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers),
    * [customer bank
    * account](https://developer.gocardless.com/pro/#api-endpoints-customer-bank-accounts),
    * and
    * [mandate](https://developer.gocardless.com/pro/#api-endpoints-mandates),
    * and returns the ID of the mandate. You may wish to create a
    * [subscription](https://developer.gocardless.com/pro/#api-endpoints-subscriptions)
    * or [payment](https://developer.gocardless.com/pro/#api-endpoints-payments)
    * at this point.
    * 
    * It is recommended that you link the redirect
    * flow to your user object as soon as it is created, and attach the created
    * resources to that user in the complete step.
    * 
    * Redirect flows
    * expire 30 minutes after they are first created. You cannot
    * [complete](https://developer.gocardless.com/pro/#complete-a-redirect-flow)
    * an expired redirect flow.
    * 
    * [View an example
    * integration](https://pay-sandbox.gocardless.com/AL000000AKFPFF) that uses
    * redirect flows.
    *
    * @return Services\RedirectFlow
    */
    public function redirect_flows()
    {
        if (!isset($this->redirect_flows)) {
            $this->redirect_flows = new Services\RedirectFlow($this->http_client);
        }
        return $this->redirect_flows;
    }

  /**
    * Refunds
    *
    * Refund objects represent (partial) refunds of a
    * [payment](https://developer.gocardless.com/pro/#api-endpoints-payment)
    * back to the
    * [customer](https://developer.gocardless.com/pro/#api-endpoints-customers).

    *    * 
    * The API allows you to create, show, list and update your
    * refunds.
    * 
    * GoCardless will notify you via a
    * [webhook](https://developer.gocardless.com/pro/#webhooks) whenever a
    * refund is created, and will update the `amount_refunded` property of the
    * payment.
    * 
    * _Note:_ A payment that has been (partially) refunded
    * can still receive a late failure or chargeback from the banks.
    *
    * @return Services\Refund
    */
    public function refunds()
    {
        if (!isset($this->refunds)) {
            $this->refunds = new Services\Refund($this->http_client);
        }
        return $this->refunds;
    }

  /**
    * Roles
    *
    * <a name="insufficient_permissions"></a>Roles represent a set of
    * permissions that may be granted to a user. The permissions are specified
    * at the resource-type level, and can be `full_access` or `read_only`. If a
    * resource-type is not included that role's users will have no access to
    * resources of that type, and will receive an `insufficient_permissions`
    * error when trying to use those endpoints.
    * 
    * A role's
    * `permissions` attribute is used to set/show the permissions for a role and
    * it's key/value pairs are restricted to the below:
    * 
    * <dl>
    * 
    *  <dt><p><code>resource</code></p></dt>
    *   <dd><p>One of:</p>
    *   
    *  <ul>
    *       <li><code>customers</code></li>
    *      
    * <li><code>customer_bank_accounts</code></li>
    *      
    * <li><code>mandates</code></li>
    *       <li><code>payments</code></li>

    *    *       <li><code>payouts</code></li>
    *      
    * <li><code>creditors</code></li>
    *      
    * <li><code>creditor_bank_accounts</code></li>
    *      
    * <li><code>roles</code></li>
    *       <li><code>users</code></li>
    * 
    *      <li><code>events</code></li>
    *      
    * <li><code>api_keys</code></li>
    *      
    * <li><code>subscriptions</code></li>
    *      
    * <li><code>redirect_flows</code></li>
    *     </ul>
    *   </dd>
    *
    * </dl>
    * 
    * <dl>
    *   <dt><p><code>access</code></p></dt>
    * 
    *  <dd><p>One of:</p>
    *     <ul>
    *      
    * <li><code>full_access</code>: read and write all records of this
    * type</li>
    *       <li><code>read_only</code>: list and show endpoints
    * available, but not create, update, delete, or actions</li>
    *    
    * </ul>
    *   </dd>
    * </dl>
    * 
    *
    * @return Services\Role
    */
    public function roles()
    {
        if (!isset($this->roles)) {
            $this->roles = new Services\Role($this->http_client);
        }
        return $this->roles;
    }

  /**
    * Subscriptions
    *
    * Subscriptions create
    * [payments](https://developer.gocardless.com/pro/#api-endpoints-payments)
    * according to a schedule.
    * 
    * #### Recurrence Rules
    * 
    *
    * The following rules apply when specifying recurrence:
    * - The first
    * payment must be charged within 1 year.
    * - When neither `month` nor
    * `day_of_month` are present, the subscription will recur from the
    * `start_at` based on the `interval_unit`.
    * - If `month` or
    * `day_of_month` are present, the recurrence rules will be applied from the
    * `start_at`, and the following validations apply:
    * 
    * |
    * interval_unit   | month                                          |
    * day_of_month                            |
    * | :-------------- |
    * :--------------------------------------------- |
    * :-------------------------------------- |
    * | yearly          |
    * optional (required if `day_of_month` provided) | optional (required if
    * `month` provided) |
    * | monthly         | invalid                     
    *                   | required                                |
    * |
    * weekly          | invalid                                        | invalid
    *                                 |
    * 
    * Examples:
    * 
    * |
    * interval_unit   | interval   | month   | day_of_month   | valid?          
    *                                   |
    * | :-------------- | :--------- |
    * :------ | :------------- |
    * :------------------------------------------------- |
    * | yearly       
    *   | 1          | january | -1             | valid                         
    *                     |
    * | yearly          | 1          | march   |    
    *            | invalid - missing `day_of_month`                   |
    * |
    * monthly         | 6          |         | 12             | valid           
    *                                   |
    * | monthly         | 6          |
    * august  | 12             | invalid - `month` must be blank                
    *    |
    * | weekly          | 2          |         |                |
    * valid                                              |
    * | weekly       
    *   | 2          | october | 10             | invalid - `month` and
    * `day_of_month` must be blank |
    * 
    * #### Rolling dates
    * 
   
    * * When a charge date falls on a non-business day, one of two things will
    * happen:
    * 
    * - if the recurrence rule specified `-1` as the
    * `day_of_month`, the charge date will be rolled __backwards__ to the
    * previous business day (i.e., the last working day of the month).
    * -
    * otherwise the charge date will be rolled __forwards__ to the next business
    * day.
    * 
    *
    * @return Services\Subscription
    */
    public function subscriptions()
    {
        if (!isset($this->subscriptions)) {
            $this->subscriptions = new Services\Subscription($this->http_client);
        }
        return $this->subscriptions;
    }

  /**
    * Users
    *
    * @return Services\User
    */
    public function users()
    {
        if (!isset($this->users)) {
            $this->users = new Services\User($this->http_client);
        }
        return $this->users;
    }


  /**
    * Get the client library's internal http client.
    * @return Core\HttpClient
    */
    public function http_client()
    {
        return $this->http_client;
    }
}
