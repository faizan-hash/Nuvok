@extends('layout.app')
@section('content')
    @include('landing-page.banner.section')

    @includeWhen($fSectSettings->features_active == 1, 'landing-page.features.section')

    @includeWhen($fSectSettings->generators_active == 1, 'landing-page.generators.section')

    @includeWhen($fSectSettings->who_is_for_active == 1, 'landing-page.who-is-for.section')

    @includeWhen($fSectSettings->custom_templates_active == 1, 'landing-page.custom-templates.section')

    @includeWhen($fSectSettings->tools_active == 1, 'landing-page.tools.section')

    {{-- Industry Use Cases section --}}
    @include('landing-page.industry-use-cases.section')

    @includeWhen($fSectSettings->how_it_works_active == 1, 'landing-page.how-it-works.section')

    @includeWhen($fSectSettings->testimonials_active == 1, 'landing-page.testimonials.section')
    
    
    @includeWhen($fSectSettings->testimonials_active == 1, 'landing-page.security-section.section')
    @includeWhen($fSectSettings->testimonials_active == 1, 'landing-page.resources-section.section')
    @includeWhen($fSectSettings->testimonials_active == 1, 'landing-page.workflow.section')
    @includeWhen($fSectSettings->pricing_active == 1, 'landing-page.businesstools.section')
    @includeWhen($fSectSettings->pricing_active == 1, 'landing-page.pricing.section')

    @includeWhen($fSectSettings->faq_active == 1, 'landing-page.faq.section')

    @includeWhen($fSectSettings->blog_active == 1, 'landing-page.blog.section')

    @includeWhen($setting->gdpr_status == 1, 'landing-page.gdpr')
@endsection
