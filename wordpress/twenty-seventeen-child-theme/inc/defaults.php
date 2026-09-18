<?php
/**
 * Default content for the redesign.
 *
 * Single source of truth. The seeder writes these into ACF on first run, and
 * the templates fall back to them when a field is empty, so the page still
 * renders correctly before seeding or if a field is cleared by mistake.
 *
 * Keys match ACF field names exactly.
 *
 * @package Twenty_Seventeen_Child
 */

defined( 'ABSPATH' ) || exit;

/** Media library URLs used by the seeder. */
function we_default_media() {
	$base = 'https://www.williamsexcavations.com.au/wp-content/uploads/';
	return array(
		'logo'        => $base . '2020/11/cropped-williams-excavations-logo.png',
		'hero'        => $base . '2020/12/baner2.jpg',
		'about'       => $base . '2020/12/WHO-WE-ARE-1.jpg',
		'cta'         => $base . '2020/11/quote-img-1.jpg',
		'svc_exc'     => $base . '2020/11/excavation.png',
		'svc_earth'   => $base . '2020/11/earthmoving.png',
		'svc_drive'   => $base . '2020/11/driveways.png',
		'svc_civil'   => $base . '2020/11/civil-works.png',
		'svc_demo'    => $base . '2020/11/demolition.png',
		'feat_drive'  => $base . '2020/12/Driveways-home.jpg',
		'feat_civil'  => $base . '2020/12/civil-works-home.jpg',
		'feat_earth'  => $base . '2020/12/earthmoving-home.jpg',
		'work1'       => $base . '2020/12/OUR-LATEST-WORK4.jpg',
		'work2'       => $base . '2020/12/OUR-LATEST-WORK3.jpg',
		'work3'       => $base . '2020/12/OUR-LATEST-WORK1.jpg',
		'work4'       => $base . '2020/12/OUR-LATEST-WORK.jpg',
		'banner3'     => $base . '2020/12/banner3.jpg',
		'poster_exc'  => $base . '2024/09/excavation-graphics.png',
		'poster_earth'=> $base . '2024/09/earthworks-graphics.png',
		'poster_drive'=> $base . '2024/09/driveways-graphics.png',
		'poster_ret'  => $base . '2024/09/retaining-wall-graphics.png',
		'poster_demo' => $base . '2024/09/demolition-graphics.png',
		'poster_gen'  => $base . '2024/09/2.jpg',
	);
}

/** Site wide defaults, seeded to the ACF options page. */
function we_default_options() {
	$m = we_default_media();
	return array(
		'opt_logo'          => $m['logo'],
		'opt_topbar_note'   => 'Proudly Tasmanian owned, fully licensed and insured',
		'opt_phone'         => '0429 680 514',
		'opt_email'         => 'info@williamsexcavations.com.au',
		'opt_address'       => 'Hobart, Tasmania 7000',
		'opt_header_cta'    => array( 'title' => 'Free Quote', 'url' => '#we-contact', 'target' => '' ),
		'opt_footer_about'  => 'With over 24 years of industry experience, Williams Excavations is a dedicated professional team of highly skilled and seasoned specialists committed to delivering the highest level of workmanship, service excellence and customer satisfaction.',
		'opt_social'        => array(
			array( 'icon' => 'fa-brands fa-facebook-f', 'url' => 'https://www.facebook.com/williamsexcavations/', 'label' => 'Facebook' ),
			array( 'icon' => 'fa-solid fa-phone',       'url' => 'tel:0429680514',                                'label' => 'Call us' ),
			array( 'icon' => 'fa-solid fa-envelope',    'url' => 'mailto:info@williamsexcavations.com.au',        'label' => 'Email us' ),
		),
		'opt_footer_links'  => array(
			array( 'label' => 'Home',        'url' => '/' ),
			array( 'label' => 'About Us',    'url' => '/about-us/' ),
			array( 'label' => 'Excavation',  'url' => '/excavation-hire-hobart/' ),
			array( 'label' => 'Earthmoving', 'url' => '/earthmoving-contractors-hobart/' ),
			array( 'label' => 'Civil Works', 'url' => '/civil-construction-hobart/' ),
			array( 'label' => 'Contact Us',  'url' => '/contact-us/' ),
		),
		'opt_footer_services' => array(
			array( 'label' => 'Driveways',               'url' => '/driveway-construction-hobart/' ),
			array( 'label' => 'Demolition',              'url' => '/demolition-contractors-hobart/' ),
			array( 'label' => 'Retaining Walls',         'url' => '/retaining-wall-construction-hobart/' ),
			array( 'label' => 'Road Repairs and Grading','url' => '/road-repair-works-hobart/' ),
			array( 'label' => 'Land Clearing',           'url' => '/land-clearing-hobart/' ),
			array( 'label' => 'Plant and Truck Hire',    'url' => '/plant-equipment-hire-hobart/' ),
		),
		'opt_footer_contact' => array(
			array( 'icon' => 'fa-solid fa-location-dot', 'text' => "Hobart, Tasmania 7000\nServicing all of Southern Tasmania", 'url' => '' ),
			array( 'icon' => 'fa-solid fa-phone',        'text' => '0429 680 514',                    'url' => 'tel:0429680514' ),
			array( 'icon' => 'fa-solid fa-envelope',     'text' => 'info@williamsexcavations.com.au', 'url' => 'mailto:info@williamsexcavations.com.au' ),
		),
		'opt_footer_cta'    => array( 'title' => 'Free Quote', 'url' => '/contact-us/', 'target' => '' ),
		'opt_copyright'     => 'Copyright ' . gmdate( 'Y' ) . ' Williams Excavations. All Rights Reserved.',
		'opt_call_label'    => 'Call Now',

		/* inner page banner */
		'opt_inner_image'        => $m['hero'],
		'opt_inner_form_tag'     => 'Fast response',
		'opt_inner_form_heading' => 'Request a Free Quote',
		'opt_inner_form_sub'     => 'Tell us about your job and we will come back to you with an obligation free price, usually the same business day.',
		'opt_inner_form_id'      => '',
		'opt_inner_form_note'    => 'We reply fast. Prefer to talk? Call 0429 680 514.',
	);
}

/** Homepage defaults, seeded to the page using the homepage template. */
function we_default_home() {
	$m = we_default_media();
	return array(
		/* hero */
		'hero_eyebrow'        => 'Excavation, Earthmoving and Civil Works in Hobart',
		'hero_heading_top'    => 'We Do More',
		'hero_heading_mid'    => 'Than Just',
		'hero_heading_accent' => 'Excavations',
		'hero_copy'           => 'For over 24 years Williams Excavations has delivered safe, fast and dependable earthmoving, civil construction and demolition across Hobart and Southern Tasmania. One experienced team, a modern fleet and a fixed price before we start.',
		'hero_image'          => $m['hero'],
		'hero_cta_primary'    => array( 'title' => 'Get Your Free Quote', 'url' => '#we-contact', 'target' => '' ),
		'hero_cta_secondary'  => array( 'title' => 'Call 0429 680 514',   'url' => 'tel:0429680514', 'target' => '' ),
		'hero_trust'          => array(
			array( 'text' => 'Free on site quotes' ),
			array( 'text' => 'Fully licensed and insured' ),
			array( 'text' => 'On time, on budget' ),
			array( 'text' => '5 star rated locally' ),
		),
		'hero_form_tag'     => 'Fast response',
		'hero_form_heading' => 'Request a Free Quote',
		'hero_form_sub'     => 'Tell us about your job and we will come back to you with an obligation free price, usually the same business day.',
		'hero_form_id'      => '',
		'hero_form_note'    => 'We reply fast. Prefer to talk? Call 0429 680 514.',

		/* stats */
		'stats' => array(
			array( 'icon' => 'fa-solid fa-award',         'number' => '24',   'decimals' => '0', 'suffix' => '+', 'label' => 'Years of experience' ),
			array( 'icon' => 'fa-solid fa-truck-monster', 'number' => '1200', 'decimals' => '0', 'suffix' => '+', 'label' => 'Projects completed' ),
			array( 'icon' => 'fa-solid fa-star',          'number' => '5',    'decimals' => '1', 'suffix' => '',  'label' => 'Average client rating' ),
			array( 'icon' => 'fa-solid fa-shield-halved', 'number' => '100',  'decimals' => '0', 'suffix' => '%', 'label' => 'Licensed and insured' ),
		),

		/* services */
		'services_eyebrow' => 'What We Do',
		'services_heading' => 'Our Services',
		'services_intro'   => 'As one of the most trusted earthmovers and excavators Hobart has to offer, we handle the whole job from first cut to final trim. Every project is quoted up front, run by qualified operators and finished to a standard you can build on.',
		'services'         => array(
			array( 'icon' => $m['svc_exc'],   'title' => 'Excavation',      'text' => 'Bulk and tight access excavation completed safely, quickly and thoroughly without blowing the budget.',    'link' => array( 'title' => 'Explore service', 'url' => '/excavation-hire-hobart/' ) ),
			array( 'icon' => $m['svc_earth'], 'title' => 'Earthmoving',     'text' => 'A modern fleet and seasoned operators ready for any project, whatever the size, scope or timeline.',        'link' => array( 'title' => 'Explore service', 'url' => '/earthmoving-contractors-hobart/' ) ),
			array( 'icon' => $m['svc_drive'], 'title' => 'Driveways',       'text' => 'Durable driveways built with the right base and the best materials, plus repairs and ongoing maintenance.', 'link' => array( 'title' => 'Explore service', 'url' => '/driveway-construction-hobart/' ) ),
			array( 'icon' => $m['svc_civil'], 'title' => 'Civil Works',     'text' => 'Site preparation, house and shed pads, drainage and final trim delivered to spec and to program.',           'link' => array( 'title' => 'Explore service', 'url' => '/civil-construction-hobart/' ) ),
			array( 'icon' => $m['svc_demo'],  'title' => 'Demolition',      'text' => 'Safe, tidy and cost effective demolition with full site clean up and responsible waste removal.',            'link' => array( 'title' => 'Explore service', 'url' => '/demolition-contractors-hobart/' ) ),
			array( 'icon' => $m['svc_civil'], 'title' => 'Retaining Walls', 'text' => 'Engineered retaining walls that hold back the slope and open up usable, level ground on your block.',        'link' => array( 'title' => 'Explore service', 'url' => '/retaining-wall-construction-hobart/' ) ),
		),

		/* poster marquee */
		'posters' => array(
			array( 'image' => $m['poster_exc'],   'alt' => 'Williams Excavations poster for excavation services in Hobart',      'link' => array( 'url' => '/excavation-hire-hobart/' ) ),
			array( 'image' => $m['poster_earth'], 'alt' => 'Williams Excavations poster for earthworks and earthmoving services','link' => array( 'url' => '/earthmoving-contractors-hobart/' ) ),
			array( 'image' => $m['poster_drive'], 'alt' => 'Williams Excavations poster for driveway construction',              'link' => array( 'url' => '/driveway-construction-hobart/' ) ),
			array( 'image' => $m['poster_ret'],   'alt' => 'Williams Excavations poster for retaining wall construction',        'link' => array( 'url' => '/retaining-wall-construction-hobart/' ) ),
			array( 'image' => $m['poster_demo'],  'alt' => 'Williams Excavations poster for demolition services',                'link' => array( 'url' => '/demolition-contractors-hobart/' ) ),
			array( 'image' => $m['poster_gen'],   'alt' => 'Williams Excavations services poster',                               'link' => array( 'url' => '/our-services/' ) ),
		),

		/* feature tiles */
		'features_eyebrow' => 'Most Requested',
		'features_heading' => 'Popular Around Hobart',
		'features'         => array(
			array( 'image' => $m['feat_drive'], 'title' => 'Driveways',   'text' => 'We construct, install, repair and maintain highly durable driveways using the best materials for your site.',      'link' => array( 'title' => 'View Driveways',   'url' => '/driveway-construction-hobart/' ) ),
			array( 'image' => $m['feat_civil'], 'title' => 'Civil Works', 'text' => 'The safest and most cost effective civil excavation Hobart property owners have come to trust and rely on.',       'link' => array( 'title' => 'View Civil Works', 'url' => '/civil-construction-hobart/' ) ),
			array( 'image' => $m['feat_earth'], 'title' => 'Earthmoving', 'text' => 'The fastest and most reliable earthmoving contractor Hobart residents have come to depend on.',                    'link' => array( 'title' => 'View Earthmoving', 'url' => '/earthmoving-contractors-hobart/' ) ),
		),

		/* about */
		'about_eyebrow'      => 'Who We Are',
		'about_heading'      => 'Earthmovers and Excavators Hobart Relies On',
		'about_image'        => $m['about'],
		'about_badge_number' => '24',
		'about_badge_label'  => 'Years on the tools',
		'about_lead'         => 'Williams Excavations is a proudly Tasmanian owned and operated team of excavation, earthmoving and civil construction specialists. With more than 24 years of industry experience behind us, we are committed to the highest level of workmanship, service and customer satisfaction on every job we take on.',
		'about_copy'         => 'Our qualified operators run a fleet of well maintained modern heavy machinery and light equipment, so we can complete any project regardless of size, scope or time constraint, within budget and on time every single time.',
		'about_list'         => array(
			array( 'text' => 'Fully insured and licensed' ),
			array( 'text' => 'Free on site quoting' ),
			array( 'text' => 'Modern, well maintained fleet' ),
			array( 'text' => 'Strict safety and quality standards' ),
			array( 'text' => 'Residential and commercial work' ),
			array( 'text' => 'Servicing all of Southern Tasmania' ),
		),
		'about_cta_primary'   => array( 'title' => 'More About Us', 'url' => '/about-us/', 'target' => '' ),
		'about_cta_secondary' => array( 'title' => '0429 680 514',  'url' => 'tel:0429680514', 'target' => '' ),

		/* process */
		'process_eyebrow' => 'How We Work',
		'process_heading' => 'Simple Process, Solid Results',
		'process_intro'   => 'No guesswork and no surprise invoices. Here is exactly what happens from your first call to the final clean up.',
		'process_steps'   => array(
			array( 'step' => 'Step 01', 'title' => 'Talk To Us',      'text' => 'Call or send the form. We listen to the scope, the access and your timeframe.',        'icon' => 'fa-solid fa-phone-volume' ),
			array( 'step' => 'Step 02', 'title' => 'Free Site Quote', 'text' => 'We visit the site, assess the ground conditions and give you a clear written price.', 'icon' => 'fa-solid fa-clipboard-list' ),
			array( 'step' => 'Step 03', 'title' => 'We Get To Work',  'text' => 'The right machine and the right operator arrive on the agreed date, ready to go.',    'icon' => 'fa-solid fa-truck-monster' ),
			array( 'step' => 'Step 04', 'title' => 'Clean Handover',  'text' => 'The job is finished to spec, the site is left tidy and you get a final walk through.', 'icon' => 'fa-solid fa-handshake' ),
		),

		/* projects */
		'projects_eyebrow' => 'Recent Projects',
		'projects_heading' => 'Our Latest Work',
		'projects_intro'   => 'A look at recent excavation, earthmoving and civil jobs completed across Hobart and the surrounding areas.',
		'projects'         => array(
			array( 'image' => $m['work1'],      'caption' => 'Bulk Excavation' ),
			array( 'image' => $m['work2'],      'caption' => 'Site Cut' ),
			array( 'image' => $m['work3'],      'caption' => 'House Pad' ),
			array( 'image' => $m['work4'],      'caption' => 'Demolition' ),
			array( 'image' => $m['feat_civil'], 'caption' => 'Civil Works' ),
			array( 'image' => $m['banner3'],    'caption' => 'Land Clearing' ),
			array( 'image' => $m['feat_drive'], 'caption' => 'Driveways' ),
			array( 'image' => $m['feat_earth'], 'caption' => 'Earthmoving' ),
		),

		/* reviews */
		'reviews_eyebrow' => 'Client Feedback',
		'reviews_heading' => 'What Our Clients Say',
		'reviews'         => array(
			array( 'rating' => '5', 'name' => 'Sophie Nichols', 'location' => 'Hobart, Tasmania',   'text' => '"I have used the Williams Excavations team on a number of occasions over the years and I would not use anyone else. Their professionalism, quality of job and price is second to none. Love working with them as they are efficient and really work with you."' ),
			array( 'rating' => '5', 'name' => 'David Bailey',   'location' => 'Southern Tasmania',  'text' => '"Top class operator who carried out quite a tricky job to a very high level. We would highly recommend this provider and would not hesitate in using them again."' ),
			array( 'rating' => '5', 'name' => 'Joshua R',       'location' => 'Hobart, Tasmania',   'text' => '"Williams Excavations provides fantastic service and produces quality outcomes. I have used these guys on multiple projects and I can highly recommend Lawrence and the team."' ),
		),

		/* quote band */
		'cta_eyebrow'   => 'No Obligation',
		'cta_heading'   => 'Get Your Free Quote Today',
		'cta_text'      => 'Years of industry experience and a hassle free quoting process. Tell us about your next job and we will price it properly, the first time.',
		'cta_image'     => $m['cta'],
		'cta_primary'   => array( 'title' => 'Request a Quote', 'url' => '#we-contact', 'target' => '' ),
		'cta_secondary' => array( 'title' => '0429 680 514',    'url' => 'tel:0429680514', 'target' => '' ),

		/* guide and faq */
		'faq_eyebrow'      => 'Your Questions Answered',
		'faq_heading'      => 'Excavation and Earthmoving in Hobart: What You Need to Know',
		'faq_intro_lead'   => 'Whether you are planning a new driveway, clearing a block for a build, or taking on a full civil construction project, excavation and earthmoving work can feel like unfamiliar territory. Most property owners only go through this process once or twice in a lifetime, so it is completely normal to have questions about cost, timing, permits, and what actually happens once the machines arrive on site.',
		'faq_intro_more'   => "<p>Williams Excavations has been serving Hobart and the surrounding areas of Southern Tasmania for over 24 years, and in that time we have fielded almost every question a homeowner, builder, or developer could ask. As a proudly Tasmanian and family-owned business, we believe an informed client makes for a smoother project from start to finish. That is why we have put together this guide to the questions we hear most often, covering everything from budgeting and scheduling to permits and site conditions.</p>\n<p>Our team operates a fleet of well-maintained modern machinery and light equipment, and we take on projects of every size and scope, from a single residential driveway to large-scale civil works and demolition. No matter how big or small the job, our approach stays the same: safe, efficient, and reliable work, delivered within budget and on time, every single time.</p>\n<p>Below you will find detailed answers to the five questions we are asked most frequently. If you cannot find what you are looking for, our team is always happy to talk it through over the phone or during a free, no-obligation, on-site quote.</p>",
		'faq_cta_primary'   => array( 'title' => 'Get Your Free Quote', 'url' => '#we-contact', 'target' => '' ),
		'faq_cta_secondary' => array( 'title' => 'Call 0429 680 514',   'url' => 'tel:0429680514', 'target' => '' ),
		'faq_list_heading'  => 'Frequently Asked Questions',
		'faqs'              => we_default_faqs(),

		/* contact */
		'contact_eyebrow'      => 'Get In Touch',
		'contact_heading'      => 'Contact Williams Excavations',
		'contact_intro'        => 'Providing a wide range of excavation and earthmoving services throughout Southern Tasmania. Complete the form and we will be in touch as soon as possible.',
		'contact_cards'        => array(
			array( 'icon' => 'fa-solid fa-phone',        'title' => 'Call Us',      'text' => '0429 680 514',                    'url' => 'tel:0429680514', 'wide' => '0' ),
			array( 'icon' => 'fa-solid fa-envelope',     'title' => 'Email Us',     'text' => 'info@williamsexcavations.com.au', 'url' => 'mailto:info@williamsexcavations.com.au', 'wide' => '0' ),
			array( 'icon' => 'fa-solid fa-location-dot', 'title' => 'Service Area', 'text' => "Hobart, Tasmania 7000\nand all of Southern Tasmania", 'url' => '', 'wide' => '1' ),
		),
		'contact_map'          => 'https://maps.google.com/maps?q=Hobart%2C%20Tasmania%207000%2C%20Australia&t=&z=12&ie=UTF8&iwloc=&output=embed',
		'contact_form_heading' => 'Send Us a Message',
		'contact_form_sub'     => 'Complete the form below and click send. We will be in touch as soon as possible.',
		'contact_form_id'      => '',
		'contact_form_note'    => 'We usually reply the same business day. For anything urgent please call 0429 680 514.',
	);
}

/** The ten guide questions and answers. */
function we_default_faqs() {
	return array(
		array(
			'question' => 'How much does excavation and earthmoving cost in Hobart?',
			'answer'   => "<p>This is, understandably, the question we are asked more than any other, and the honest answer is that it depends on your site. The size and slope of the block, the soil and rock involved, machinery access, and whether services such as water, gas, or electricity run through the work area will all affect the final price. A straightforward driveway excavation on flat, accessible ground will cost considerably less than a house site cut on a steep, rocky block with limited truck access.</p>\n<p>Scope matters too, since some projects need only cutting and levelling, while others require cut and fill balancing, retaining structures, drainage, or spoil removal. Because so many variables come into play, we avoid quoting generic figures over the phone. Instead, we offer a free on site quote so an experienced estimator can assess your block in person and put together a detailed, transparent price based on the real conditions of your property.</p>",
		),
		array(
			'question' => 'How long does a typical excavation or earthmoving project take?',
			'answer'   => "<p>Project timelines vary just as much as costs do, and depend heavily on the scale of the job, ground conditions, weather, and how much preparatory work is needed before excavation can begin. A small residential driveway or a simple site cut for a shed might be completed within a day or two, while a full house site excavation, complete with cut and fill, drainage, and retaining work, can take a week to several weeks.</p>\n<p>Larger civil works and subdivision projects extend further, particularly when staged approvals or service connections are involved. Weather is one of the biggest variables in Tasmania, since heavy or prolonged rain can make a site unsafe for heavy machinery, and our crews will always prioritise safety over a schedule. Once we have assessed your site, we will give you a realistic timeframe based on decades of local experience, and keep you informed if conditions require any adjustment.</p>",
		),
		array(
			'question' => 'Do I need council approval or permits before starting earthworks in Tasmania?',
			'answer'   => "<p>In many cases, yes, and this is one of the most important things to sort out before any digging begins. Whether you need a permit depends on the scale of the earthworks, whether the property sits in a bushfire or flood prone area, whether the work affects drainage on neighbouring properties, and whether it is connected to a broader development that already requires approval. Minor landscaping on a standard residential block may not need formal council sign off, while larger cut and fill works, retaining walls above a certain height, or earthworks near a boundary generally will.</p>\n<p>Every council in Tasmania administers its own planning scheme, so requirements differ between municipalities, which is why we recommend checking directly with your local council before committing to a timeline. It is also worth arranging for underground services to be located before work begins. Approvals ultimately remain the responsibility of the property owner or their builder.</p>",
		),
		array(
			'question' => 'What should I look for when choosing an excavation and earthmoving contractor?',
			'answer'   => "<p>Choosing the right contractor makes a real difference to how smoothly your project runs. First, confirm the company is fully licensed and insured, since excavation work carries real risks to workers, property, and underground infrastructure.</p>\n<p>Second, ask about experience with projects similar to yours, since the skills needed for a driveway differ from those needed for a complex civil works or demolition job. A contractor with a long local track record will understand typical soil conditions and council expectations in your area.</p>\n<p>Third, look closely at how the quote is presented, since a detailed, itemised quote from an on site inspection is far more reliable than a vague phone estimate. It is also worth asking about the age of the equipment used, as well maintained machinery means fewer breakdowns and safer operation.</p>\n<p>Finally, ask for references or read reviews, and note how responsive and transparent the contractor is from your first conversation.</p>",
		),
		array(
			'question' => 'What happens if unexpected conditions, such as rock, buried services, or wet weather, are found during the job?',
			'answer'   => "<p>Even with careful planning, ground conditions can never be predicted with complete certainty until excavation begins, and experienced contractors build flexibility into how they handle surprises. If our crew encounters solid rock where softer ground was expected, we have the equipment and experience to manage it safely, though it may affect the timeframe and cost, and we will discuss this before proceeding. Striking a buried service that was not marked is treated as a safety priority above all else, work stops immediately, and we work with you to resolve the issue.</p>\n<p>Wet weather is a particularly common disruption in Tasmania, and heavy rain can turn a stable site unsafe almost overnight, so we will pause work until conditions allow us to continue safely and keep you updated. Throughout any of these scenarios, our priority is open communication, since we would rather explain a delay or cost adjustment clearly and early than let a client feel blindsided.</p>",
		),
		array(
			'question' => 'What is the difference between excavation, earthmoving, and civil works?',
			'answer'   => "<p>These terms are often used interchangeably, but they cover slightly different parts of a project. Excavation generally refers to the digging, cutting, and removal of soil, rock, or debris from a specific area, such as preparing a house site or digging trenches for services. Earthmoving is a broader term covering the movement, levelling, and redistribution of large volumes of material across a site, often using excavators, bobcats, and dump trucks.</p>\n<p>Civil works generally sits above both, referring to the wider infrastructure side of a project, such as road construction, stormwater and drainage systems, retaining structures, and site works that support a subdivision or larger development. In practice, most projects involve a combination of all three, and a contractor experienced across the full range can manage a job from the first cut through to the finished, drained site.</p>",
		),
		array(
			'question' => 'What is included in a free on site quote?',
			'answer'   => "<p>A free on site quote gives us the chance to assess your property in person rather than relying on photos or a description over the phone, and it is the best way to arrive at an accurate, honest price. During the visit, one of our estimators will look at the slope, soil, and access of your site, ask what you are hoping to achieve, and identify anything that could affect scope, such as nearby services, retaining requirements, or drainage.</p>\n<p>We will talk through the options available, explain roughly how long the project is likely to take, and answer any questions you have. You will then receive a detailed, itemised quote, so there are no vague allowances or hidden extras. There is no cost and no obligation to proceed.</p>",
		),
		array(
			'question' => 'Can you handle site preparation and land clearing for a new build?',
			'answer'   => "<p>Yes, site preparation and land clearing are among the most common projects we take on, particularly for clients getting ready to build a new home or shed. This typically involves clearing vegetation, removing trees, stumps, and debris, then cutting and levelling the site to the correct height and grade for construction. Depending on the block, it can also include cut and fill work to manage slope, drainage to redirect surface water away from the building area, and compaction of the finished pad to meet your builder's requirements.</p>\n<p>Because site preparation sets the foundation for everything that follows, getting it right the first time matters, and our team works closely with builders and owners to make sure the finished site meets the exact specifications needed before construction begins.</p>",
		),
		array(
			'question' => 'Do you take on both small residential jobs and larger commercial or civil projects?',
			'answer'   => "<p>We take on projects of every size, from a single residential driveway or retaining wall to large scale civil works, subdivisions, and commercial developments. Our fleet of well-maintained modern machinery allows us to scale our approach to suit the job, so a small backyard project receives the same attention to detail and safety standards as a major civil contract.</p>\n<p>Many of our clients are homeowners undertaking a one off project, while others are builders, developers, or councils working with us across multiple jobs. Regardless of scale, our philosophy stays the same, which is to deliver safe, efficient, and reliable work within budget and on time, backed by over 24 years of experience across Hobart and Southern Tasmania.</p>",
		),
		array(
			'question' => 'What happens to the soil and material removed during excavation?',
			'answer'   => "<p>What happens to excavated soil and material depends on its condition and the needs of your project. In some cases, we can reuse suitable material on site for fill, levelling, or landscaping, reducing both cost and environmental impact. Where material is unsuitable for reuse, such as heavy clay, rock, or contaminated fill, it is removed using our truck fleet and taken to an appropriate facility for disposal or recycling in line with relevant regulations.</p>\n<p>We will discuss the likely volume and condition of spoil during your onsite quote, since removal and disposal can be a meaningful part of the cost on larger projects. Our aim is always to manage material as efficiently and responsibly as possible, keeping unnecessary truck movements to a minimum.</p>",
		),
	);
}
