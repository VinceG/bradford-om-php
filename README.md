# Bradford Order Management

PHP Integration for the Bradford Order Management

## Installation

```
composer require vince-g/bradford-om-php
```

## Examples

### Initiate Client

```php
$client = new Client(AMCUSERNAME, AMCPASSWORD, $httpClientOptions);
// Disable SSL
$client = new Client(AMCUSERNAME, AMCPASSWORD, ['verify' => false]);
// Set path to .pem
$client = new Client(AMCUSERNAME, AMCPASSWORD, ['verify' => '/path/to/cert.pem']);
```

#### Appraiser Identity

```php
$request = new AppraiserIdentity($client);
$request->setMemberId('xxx00040');
// Or by email
// $request->setMemberEmail('xxx@bradfordsoftware.com');
$request->get()->process();

$memberId = $request->getResult();
```

#### Create Order

```php
$request = new CreateOrder($client);
$request->setMemberId('xxx00040');

$fields = new OrderFields;
$fields->setFields([
        'OrderId' => '12345',
        'PropAddress' => '5440 Tujunga Ave',
        'PropCity' => 'North Hollywood',
        'PropState' => 'CA',
        'PropZip' => '91601',
        'BorrowerFirstname' => 'Vincent',
        'BorrowerLastname' => 'Gabriel',
        'BorrowerEmail' => 'xxx@xxx.com',
        'BorrowerPhone' => 'xxx-xxx-xxxx',
        'AppraisalType' => 'Appraisal Review',

        'PropAddress2' => 'APT 100',
        'PropType' => 'Single Family Residence',
        'LenderName' => 'Landmark Network Inc.',
        'LenderAddress' => '5161 Lankershim Blvd',
        'LenderCity' => 'North Hollywood',
        'LenderState' => 'CA',
        'LenderZip' => '91601',
        'LoanRefNumber' => '12345',
]);

$request->setOrderFields($fields);
$request->get()->process();

$confirmation = $request->getResult();
```

#### Update Order

```php
$request = new UpdateOrder($client);
$request->setMemberId('xxx00040');

$fields = new OrderFields;
$fields->setFields([
        'OrderId' => '12345',
        'PropAddress' => '5440 Tujunga Ave',
        'PropCity' => 'North Hollywood',
        'PropState' => 'CA',
        'PropZip' => '91601',
        'BorrowerFirstname' => 'Vincent',
        'BorrowerLastname' => 'Gabriel',
        'BorrowerEmail' => 'xxx@xxx.com',
        'BorrowerPhone' => 'xxx-xxx-xxxx',
        'AppraisalType' => 'Appraisal Review',

        'PropAddress2' => 'APT 100',
        'PropType' => 'Single Family Residence',
        'LenderName' => 'Landmark Network Inc.',
        'LenderAddress' => '5161 Lankershim Blvd',
        'LenderCity' => 'North Hollywood',
        'LenderState' => 'CA',
        'LenderZip' => '91601',
        'LoanRefNumber' => '12345',
]);

$request->setOrderFields($fields);
$request->get()->process();

$confirmation = $request->getResult();
```

#### Delete Order

```php
$request = new DeleteOrder($client);
$request->setMemberId('xxx00040');
$request->setOrderId('12345');

$request->get()->process();

$confirmation = $request->getResult();
```

#### Get Order Status

```php
$request = new GetOrderStatus($client);
$request->setMemberId('xxx00040');
$request->setOrderId('12345');

$request->get()->process();

$status = $request->getResult();
```

## Tests

```
phpunit
```