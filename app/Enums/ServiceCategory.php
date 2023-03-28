<?php

namespace App\Enums;

enum ServiceCategory: string
{
    case BEAUTY = 'beauty';
    case FITNESS = 'fitness';
    case WELLNESS = 'wellness';
    case MEDICAL = 'medical';
    case HOME = 'home';
    case EVENT = 'event';
    case EDUCATION = 'education';
    case AUTOMOTIVE = 'automotive';
    case BUSINESS = 'business';
    case TRAVEL = 'travel';

    public static function getSubcategories(self $category): array
    {
        return match ($category) {
            self::BEAUTY => [
                ServiceSubcategory::HAIRCUTS,
                ServiceSubcategory::STYLING,
                ServiceSubcategory::COLORING,
                ServiceSubcategory::WAXING,
                ServiceSubcategory::MAKEUP,
                ServiceSubcategory::MANICURES_PEDICURES,
            ],
            self::FITNESS => [
                ServiceSubcategory::PERSONAL_TRAINING,
                ServiceSubcategory::YOGA,
                ServiceSubcategory::PILATES,
                ServiceSubcategory::CROSSFIT,
                ServiceSubcategory::DANCE_CLASSES,
            ],
            self::WELLNESS => [
                ServiceSubcategory::MASSAGE,
                ServiceSubcategory::ACUPUNCTURE,
                ServiceSubcategory::NUTRITION,
                ServiceSubcategory::SPA,
                ServiceSubcategory::SAUNA,
            ],
            self::MEDICAL => [
                ServiceSubcategory::GENERAL_PRACTITIONER,
                ServiceSubcategory::DENTIST,
                ServiceSubcategory::DERMATOLOGIST,
                ServiceSubcategory::PSYCHOLOGIST,
                ServiceSubcategory::PHYSIOTHERAPIST,
            ],
            self::HOME => [
                ServiceSubcategory::CLEANING,
                ServiceSubcategory::HANDYMAN,
                ServiceSubcategory::GARDENING,
                ServiceSubcategory::PEST_CONTROL,
                ServiceSubcategory::PLUMBING,
            ],
            self::EVENT => [
                ServiceSubcategory::PHOTOGRAPHY,
                ServiceSubcategory::VIDEOGRAPHY,
                ServiceSubcategory::DJ,
                ServiceSubcategory::EVENT_PLANNING,
                ServiceSubcategory::CATERING,
            ],
            self::EDUCATION => [
                ServiceSubcategory::TUTORING,
                ServiceSubcategory::LANGUAGE_CLASSES,
                ServiceSubcategory::MUSIC_CLASSES,
                ServiceSubcategory::ART_CLASSES,
                ServiceSubcategory::COOKING_CLASSES,
            ],
            self::AUTOMOTIVE => [
                ServiceSubcategory::CAR_WASH,
                ServiceSubcategory::AUTO_MECHANIC,
                ServiceSubcategory::AUTO_BODY_REPAIR,
                ServiceSubcategory::CAR_RENTAL,
                ServiceSubcategory::DRIVING_LESSONS,
            ],
            self::BUSINESS => [
                ServiceSubcategory::ACCOUNTING,
                ServiceSubcategory::LEGAL_SERVICES,
                ServiceSubcategory::MARKETING,
                ServiceSubcategory::IT_SERVICES,
                ServiceSubcategory::CONSULTING,
            ],
            self::TRAVEL => [
                ServiceSubcategory::HOTEL,
                ServiceSubcategory::AIR_TRAVEL,
                ServiceSubcategory::CAR_RENTAL_TRAVEL,
                ServiceSubcategory::CRUISES,
                ServiceSubcategory::TOURS,
            ],
        };
    }

}

