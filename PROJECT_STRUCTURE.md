# EasyGo Project Structure

## Admin Panel - Updated Architecture

### Controller Organization

```
app/Http/Controllers/
├── Admin/
│   ├── UserManagement/
│   │   ├── DriverController.php          # Driver management
│   │   ├── DriverDocumentController.php  # Driver KYC documents
│   │   └── RiderController.php           # Rider management
│   ├── RideManagement/
│   │   ├── LiveRideController.php        # Live/active rides monitoring
│   │   ├── RideHistoryController.php     # Completed/cancelled rides
│   │   └── ScheduledRideController.php   # Future scheduled rides
│   ├── Finance/
│   │   ├── TransactionController.php     # Financial transactions
│   │   ├── PayoutController.php          # Driver payouts
│   │   └── WalletController.php        # User wallet management
│   └── Settings/
│       ├── PromotionController.php       # Promo codes & campaigns
│       ├── ReviewController.php          # User reviews & ratings
│       └── ReportController.php          # Analytics & reports
├── Web/
│   ├── DashboardController.php           # Admin dashboard
│   ├── DriverStatusController.php        # Driver online/offline status
│   ├── SettingsController.php            # Platform settings
│   └── FileController.php                # File uploads
└── Api/
    ├── Driver/                           # Driver API endpoints
    ├── Rider/                            # Rider API endpoints
    └── Common/                           # Shared API endpoints
```

### View Organization

```
resources/views/
├── admin/
│   ├── users/
│   │   ├── drivers/
│   │   │   └── index.blade.php
│   │   └── riders/
│   │       └── index.blade.php
│   ├── rides/
│   │   ├── live/
│   │   │   └── index.blade.php
│   │   ├── history/
│   │   │   └── index.blade.php
│   │   └── scheduled/
│   │       └── index.blade.php
│   ├── finance/
│   │   ├── transactions/
│   │   │   └── index.blade.php
│   │   ├── payouts/
│   │   │   └── index.blade.php
│   │   └── wallets/
│   │       ├── index.blade.php
│   │       └── partials/
│   │           └── adjust-balance-modal.blade.php
│   ├── settings/
│   │   ├── promotions/
│   │   │   └── index.blade.php
│   │   ├── reviews/
│   │   │   └── index.blade.php
│   │   └── reports/
│   │       └── index.blade.php
│   └── driver-status/
│       └── index.blade.php
├── layouts/
│   └── app.blade.php                     # Main layout (uses @yield)
├── dashboard.blade.php
└── settings/
    ├── index.blade.php
    └── partials/
        └── add-admin-modal.blade.php
```

### Key Changes Made

#### 1. Blade Layout System Updated
- **Before:** `<x-app-layout>` with `$slot`
- **After:** `@extends('layouts.app')` with `@section('content')`

#### 2. Fixed Views (Converted from Component to Layout)
- ✅ dashboard.blade.php
- ✅ admin/users/riders/index.blade.php
- ✅ admin/users/drivers/index.blade.php
- ✅ admin/rides/live/index.blade.php
- ✅ admin/rides/history/index.blade.php
- ✅ admin/rides/scheduled/index.blade.php
- ✅ admin/finance/transactions/index.blade.php
- ✅ admin/finance/payouts/index.blade.php
- ✅ admin/finance/wallets/index.blade.php
- ✅ admin/settings/promotions/index.blade.php
- ✅ admin/settings/reviews/index.blade.php
- ✅ admin/settings/reports/index.blade.php
- ✅ admin/driver-status/index.blade.php (NEW)
- ✅ settings/index.blade.php

#### 3. Database Column Mapping (Fixed)
| Old (Wrong) | New (Correct) |
|-------------|---------------|
| `name` | `full_name` (accessor: `$driver->name`) |
| `phone` | `mobile_number` |
| `email` | `email` |
| `is_online` | `is_available` |
| `vehicle_type` | `vehicle->type` (relationship) |
| `current_location` | `current_lat`, `current_lng` |

#### 4. New Controllers Created
- `Web\DriverStatusController` - Driver monitoring page
- `Web\SettingsController` - Platform configuration with data

### Available Admin Routes

| URL | Controller | Description |
|-----|------------|-------------|
| `/dashboard` | DashboardController | Main dashboard |
| `/riders` | RiderController | Rider management |
| `/drivers` | DriverController | Driver management |
| `/live-rides` | LiveRideController | Live ride tracking |
| `/ride-history` | RideHistoryController | Past rides |
| `/scheduled-rides` | ScheduledRideController | Future bookings |
| `/transactions` | TransactionController | Financial logs |
| `/payouts` | PayoutController | Driver payments |
| `/wallets` | WalletController | User wallets |
| `/promotions` | PromotionController | Promo codes |
| `/reviews` | ReviewController | Ratings & reviews |
| `/reports` | ReportController | Analytics |
| `/driver-status` | DriverStatusController | Driver online status |
| `/settings` | SettingsController | Platform settings |

### Layout System

**resources/views/layouts/app.blade.php**
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'EasyGo Admin')</title>
    <!-- ... -->
</head>
<body>
    @include('layouts.navigation')
    
    <main>
        <div>
            @yield('content')
        </div>
    </main>
</body>
</html>
```

**Usage in Views:**
```php
@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <!-- Page content here -->
@endsection
```

---

*Last Updated: April 20, 2026*
