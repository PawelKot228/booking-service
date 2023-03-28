<?php

namespace App\Enums;

enum ServiceSubcategory: string
{
    // Beauty
    case HAIRCUTS = 'haircuts';
    case STYLING = 'styling';
    case COLORING = 'coloring';
    case WAXING = 'waxing';
    case MAKEUP = 'makeup';
    case MANICURES_PEDICURES = 'manicures_pedicures';

    // Fitness
    case PERSONAL_TRAINING = 'personal_training';
    case YOGA = 'yoga';
    case PILATES = 'pilates';
    case CROSSFIT = 'crossfit';
    case DANCE_CLASSES = 'dance_classes';

    // Wellness
    case MASSAGE = 'massage';
    case ACUPUNCTURE = 'acupuncture';
    case NUTRITION = 'nutrition';
    case SPA = 'spa';
    case SAUNA = 'sauna';

    // Medical
    case GENERAL_PRACTITIONER = 'general_practitioner';
    case DENTIST = 'dentist';
    case DERMATOLOGIST = 'dermatologist';
    case PSYCHOLOGIST = 'psychologist';
    case PHYSIOTHERAPIST = 'physiotherapist';

    // Home
    case CLEANING = 'cleaning';
    case HANDYMAN = 'handyman';
    case GARDENING = 'gardening';
    case PEST_CONTROL = 'pest_control';
    case PLUMBING = 'plumbing';

    // Event
    case PHOTOGRAPHY = 'photography';
    case VIDEOGRAPHY = 'videography';
    case DJ = 'dj';
    case EVENT_PLANNING = 'event_planning';
    case CATERING = 'catering';

    // Education
    case TUTORING = 'tutoring';
    case LANGUAGE_CLASSES = 'language_classes';
    case MUSIC_CLASSES = 'music_classes';
    case ART_CLASSES = 'art_classes';
    case COOKING_CLASSES = 'cooking_classes';

    // Automotive
    case CAR_WASH = 'car_wash';
    case AUTO_MECHANIC = 'auto_mechanic';
    case AUTO_BODY_REPAIR = 'auto_body_repair';
    case CAR_RENTAL = 'car_rental';
    case DRIVING_LESSONS = 'driving_lessons';

    // Business
    case ACCOUNTING = 'accounting';
    case LEGAL_SERVICES = 'legal_services';
    case MARKETING = 'marketing';
    case IT_SERVICES = 'it_services';
    case CONSULTING = 'consulting';

    // Travel
    case HOTEL = 'hotel';
    case AIR_TRAVEL = 'air_travel';
    case CAR_RENTAL_TRAVEL = 'car_rental_travel';
    case CRUISES = 'cruises';
    case TOURS = 'tours';

    public static function getCategory(self $subcategory): ServiceCategory
    {
        return match ($subcategory) {
            self::HAIRCUTS,
            self::STYLING,
            self::COLORING,
            self::WAXING,
            self::MAKEUP,
            self::MANICURES_PEDICURES => ServiceCategory::BEAUTY,
            self::PERSONAL_TRAINING,
            self::YOGA,
            self::PILATES,
            self::CROSSFIT,
            self::DANCE_CLASSES => ServiceCategory::FITNESS,
            self::MASSAGE,
            self::ACUPUNCTURE,
            self::NUTRITION,
            self::SPA,
            self::SAUNA => ServiceCategory::WELLNESS,
            self::GENERAL_PRACTITIONER,
            self::DENTIST,
            self::DERMATOLOGIST,
            self::PSYCHOLOGIST,
            self::PHYSIOTHERAPIST => ServiceCategory::MEDICAL,
            self::CLEANING,
            self::HANDYMAN,
            self::GARDENING,
            self::PEST_CONTROL,
            self::PLUMBING => ServiceCategory::HOME,
            self::PHOTOGRAPHY,
            self::VIDEOGRAPHY,
            self::DJ,
            self::EVENT_PLANNING,
            self::CATERING => ServiceCategory::EVENT,
            self::TUTORING,
            self::LANGUAGE_CLASSES,
            self::MUSIC_CLASSES,
            self::ART_CLASSES,
            self::COOKING_CLASSES => ServiceCategory::EDUCATION,
            self::CAR_WASH,
            self::AUTO_MECHANIC,
            self::AUTO_BODY_REPAIR,
            self::CAR_RENTAL,
            self::DRIVING_LESSONS => ServiceCategory::AUTOMOTIVE,
            self::ACCOUNTING,
            self::LEGAL_SERVICES,
            self::MARKETING,
            self::IT_SERVICES,
            self::CONSULTING => ServiceCategory::BUSINESS,
            self::HOTEL,
            self::AIR_TRAVEL,
            self::CAR_RENTAL_TRAVEL,
            self::CRUISES,
            self::TOURS => ServiceCategory::TRAVEL,
        };
    }
}

