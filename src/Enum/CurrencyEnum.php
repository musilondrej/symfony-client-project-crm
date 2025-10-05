<?php
namespace App\Enum;

enum CurrencyEnum: string
{
    case USD = 'USD'; // United States, Puerto Rico
    case EUR = 'EUR'; // Euro area (AT, BE, HR, CY, EE, FI, FR, DE, GR, IE, IT, LV, LT, LU, MT, NL, PT, SK, SI, ES, + AD, MC, SM, VA)
    case JPY = 'JPY'; // Japan
    case GBP = 'GBP'; // United Kingdom
    case CAD = 'CAD'; // Canada
    case AUD = 'AUD'; // Australia
    case NZD = 'NZD'; // New Zealand
    case CHF = 'CHF'; // Switzerland (+ LI)
    case DKK = 'DKK'; // Denmark
    case NOK = 'NOK'; // Norway
    case SEK = 'SEK'; // Sweden
    case ISK = 'ISK'; // Iceland
    case ILS = 'ILS'; // Israel
    case SGD = 'SGD'; // Singapore
    case KRW = 'KRW'; // Korea (Republic of)
    case HKD = 'HKD'; // Hong Kong SAR
    case TWD = 'TWD'; // Taiwan (Province of China)
    case MOP = 'MOP'; // Macao SAR
    case CZK = 'CZK'; // Czech Republic

    public function label(): string
    {
        return match ($this) {
            self::USD => 'US Dollar',
            self::EUR => 'Euro',
            self::JPY => 'Japanese Yen',
            self::GBP => 'British Pound Sterling',
            self::CAD => 'Canadian Dollar',
            self::AUD => 'Australian Dollar',
            self::NZD => 'New Zealand Dollar',
            self::CHF => 'Swiss Franc',
            self::DKK => 'Danish Krone',
            self::NOK => 'Norwegian Krone',
            self::SEK => 'Swedish Krona',
            self::ISK => 'Icelandic Króna',
            self::ILS => 'Israeli New Shekel',
            self::SGD => 'Singapore Dollar',
            self::KRW => 'South Korean Won',
            self::HKD => 'Hong Kong Dollar',
            self::TWD => 'New Taiwan Dollar',
            self::MOP => 'Macanese Pataca',
            self::CZK => 'Czech Koruna',
        };
    }

    public function symbol(): string
    {
        return match ($this) {
            self::USD => '$',
            self::EUR => '€',
            self::JPY => '¥',
            self::GBP => '£',
            self::CAD => 'C$',
            self::AUD => 'A$',
            self::NZD => 'NZ$',
            self::CHF => 'CHF',
            self::DKK => 'kr',
            self::NOK => 'kr',
            self::SEK => 'kr',
            self::ISK => 'kr',
            self::ILS => '₪',
            self::SGD => 'S$',
            self::KRW => '₩',
            self::HKD => 'HK$',
            self::TWD => 'NT$',
            self::MOP => 'MOP$',
            self::CZK => 'Kč',
        };
    }

    public function fractionDigits(): int
    {
        return match ($this) {
            self::JPY, self::KRW, self::ISK => 0,
            default => 2,
        };
    }
}
