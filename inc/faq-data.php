<?php
/**
 * Shared FAQ content used by both page-faq.php (display) and inc/schema.php (JSON-LD).
 *
 * Reads from wp_options (Goliath Content Editor) with hardcoded defaults.
 *
 * @package MyCustomTheme
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

/**
 * FAQ items: each entry has a 'question' string and a 'paragraphs' array.
 *
 * @return array<int, array{question: string, paragraphs: string[]}>
 */
function my_theme_get_faq_items(): array
{
    $saved = get_option('my_theme_faq_items');
    if (is_array($saved) && ! empty($saved)) {
        return $saved;
    }

    return [
        [
            'question' => 'Will it fit my current pallet racking?',
            'paragraphs' => [
                'The Goliath™ racking repair kit is designed to fit most UK and EU racking manufacturers. This makes it suitable for most pallet racking systems that are currently in use. With Goliath™, you can install a single solution across mixed racking types without concerns about compatibility.',
            ],
        ],
        [
            'question' => 'How long will it take to fit?',
            'paragraphs' => [
                'Goliath™ can be fitted in less than 30 minutes. This high-speed installation process reduces any disruption compared to traditional racking upright replacement. In most cases, we can install without affecting your regular warehouse operations.',
            ],
        ],
        [
            'question' => 'Is it more expensive than just changing the damaged upright?',
            'paragraphs' => [
                'No. Our repair kit is quick to install and needs no other installation plant machinery. Goliath™ is designed to protect against any future damage, meaning you will stop replacing uprights repeatedly.',
            ],
        ],
        [
            'question' => 'Will my racking carry the same weight loading after a repair?',
            'paragraphs' => [
                'Goliath™ is tested to carry a 21,000 kg bay load with a 100% overloading safety factor built in. This means your structure retrofitted with Goliath™ will be significantly stronger than the damaged upright it replaces. Therefore, it improves load performance while improving overall structural resilience.',
            ],
        ],
        [
            'question' => 'Do you offer a warranty?',
            'paragraphs' => [
                'Yes, and to meet SEMA and EN guidelines, we offer a lifetime impact warranty for the repair and overall structure. This ensures that the new support system performs as expected once it has been installed.',
            ],
        ],
        [
            'question' => 'My racking supplier has told me this method is not approved by the racking manufacturer?',
            'paragraphs' => [
                'The simple answer is, why would they? Racking damage is big business for racking manufacturers, so a product that is unlikely to ever need replacing directly challenges that model. Goliath™ was built to provide a faster, more cost-effective solution to concerns about rising costs.',
            ],
        ],
        [
            'question' => "I've been told you can't have a splice below the bottom beam level?",
            'paragraphs' => [
                'Goliath™ is not a splice. Yes, we agree that you should not have a splice below the bottom beam level, which is why Goliath™ has been designed differently to avoid that practice. The damaged upright is cut out using a specially designed jig, creating a factory-quality cut that allows loads to transfer correctly through the structure. This method differs from standard splicing kits, which do not follow the same approach.',
            ],
        ],
        [
            'question' => 'How do you know your product is safe to use?',
            'paragraphs' => [
                'Goliath™ has received testing to allow it to conform to recognised standards. These include BS EN 15512:2020 + A1:2022 for structural design and BS EN 15635:2008 for application and maintenance of storage equipment. This ensures our product meets established safety and performance requirements for pallet racking systems.',
            ],
        ],
        [
            'question' => 'Is Goliath™ compliant with regulations?',
            'paragraphs' => [
                'Yes. Goliath™ is designed to align with recognised UK and European safety standards, including HSE guidance, EN standards, and SEMA best practice. Goliath™ supports this by reducing impact damage, which is one of the main causes of non-compliance.',
                'It has also been independently tested to ensure performance in real-world conditions.',
            ],
        ],
        [
            'question' => 'Do I still need racking inspections?',
            'paragraphs' => [
                'Yes. Regular inspections are essential for safety and compliance.',
            ],
        ],
    ];
}
