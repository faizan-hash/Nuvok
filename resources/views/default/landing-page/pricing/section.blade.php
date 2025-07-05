<<<<<<< HEAD
=======
<!--2nd code-->
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
    
    <!-- Load Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <!-- Load Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
<<<<<<< HEAD
            background-color: #F9FAFB;
=======
            background-color: #F9FAFB; /* Light Gray */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            margin: 0;
            padding: 0;
        }

        .site-section {
            padding: 40px 0;
            transition: transform 0.7s, opacity 0.7s;
        }
        .site-section:not(.lqd-is-in-view) {
            transform: translateY(32px);
            opacity: 0;
        }
        .site-section.lqd-is-in-view {
            transform: translateY(0);
            opacity: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        .pricing-box {
<<<<<<< HEAD
            border: 1px solid #1C2A39;
            border-radius: 32px;
            padding: 44px;
            background-color: #F9FAFB;
=======
            border: 1px solid #1C2A39; /* Deep Navy */
            border-radius: 32px;
            padding: 44px;
            background-color: #F9FAFB; /* Light Gray */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }

        .pricing-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .pricing-header h2 {
            font-size: 36px;
            font-weight: 700;
<<<<<<< HEAD
            color: #1C2A39;
=======
            color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            margin: 0;
        }
        .pricing-header p {
            font-size: 18px;
<<<<<<< HEAD
            color: #1C2A39;
=======
            color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            margin-top: 8px;
        }

        /* Toggle Switch */
        .tabs-triggers {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 36px;
        }
        .tabs-triggers button {
            padding: 8px 16px;
            font-size: 15px;
            font-weight: 500;
<<<<<<< HEAD
            border: 1px solid #1C2A39;
            border-radius: 8px;
            background-color: #F9FAFB;
            color: #1C2A39;
=======
            border: 1px solid #1C2A39; /* Deep Navy */
            border-radius: 8px;
            background-color: #F9FAFB; /* Light Gray */
            color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .tabs-triggers button.active {
<<<<<<< HEAD
            background-color: #6EE7B7;
            color: #1C2A39;
            border-color: #6EE7B7;
=======
            background-color: #6EE7B7; /* Mint Green */
            color: #1C2A39; /* Deep Navy */
            border-color: #6EE7B7; /* Mint Green */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
        .tabs-triggers .save-badge {
            margin-left: 4px;
            font-size: 12px;
<<<<<<< HEAD
            background-color: #B06F49;
            color: #F9FAFB;
=======
            background-color: #B06F49; /* Muted Copper */
            color: #F9FAFB; /* Light Gray */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* Swiper Container */
        .swiper-container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 0 10px;
            overflow: hidden;
        }
        .swiper-slide {
            display: flex;
            justify-content: center;
            width: 300px;
            box-sizing: border-box;
<<<<<<< HEAD
            padding-top: 20px;
=======
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }

        /* Pricing Card */
        .lqd-tabs-content-wrap {
<<<<<<< HEAD
            --pricing-card-height: 650px;
        }
        .lqd-tabs-content-wrap.annual-active {
            --pricing-card-height: 675px;
        }
        .pricing-card {
            background-color: #F9FAFB;
            border: 1px solid #1C2A39;
=======
            --pricing-card-height: 572px;
        }
        .lqd-tabs-content-wrap.annual-active {
            --pricing-card-height: 595px;
        }
        .pricing-card {
            background-color: #F9FAFB; /* Light Gray */
            border: 1px solid #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            min-height: var(--pricing-card-height);
            width: 100%;
            transition: transform 0.3s;
<<<<<<< HEAD
            position: relative;
        }
        .pricing-card:hover {
            transform: translateY(-4px);
            border-color: #6EE7B7;
        }

        /* Plan Badge */
        .plan-badge {
            position: absolute;
            top: 0px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(45deg, #6EE7B7, #B06F49);
            color: #1C2A39;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .pricing-card h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1C2A39;
            margin: 12px 0 0 0;
            text-align: center;
=======
        }
        .pricing-card:hover {
            transform: translateY(-4px);
            border-color: #6EE7B7; /* Mint Green on hover */
        }
        .pricing-card h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1C2A39; /* Deep Navy */
            margin: 0;
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
        .pricing-card .price {
            font-size: 30px;
            font-weight: 700;
<<<<<<< HEAD
            color: #1C2A39;
            margin-top: 16px;
            text-align: center;
=======
            color: #1C2A39; /* Deep Navy */
            margin-top: 16px;
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
        .pricing-card .price span {
            font-size: 16px;
            font-weight: 400;
<<<<<<< HEAD
            color: #1C2A39;
        }
        .pricing-card .annual-text {
            font-size: 14px;
            color: #1C2A39;
            margin-top: 4px;
            display: none;
            text-align: center;
        }

        /* AI Tokens Display */
        .tokens-info {
            background-color: #6EE7B7;
            border-radius: 8px;
            padding: 12px;
            margin: 16px 0;
            text-align: center;
        }
        .tokens-info .tokens-amount {
            font-size: 18px;
            font-weight: 600;
            color: #1C2A39;
        }
        .tokens-info .tokens-label {
            font-size: 12px;
            color: #1C2A39;
            margin-top: 4px;
        }

=======
            color: #1C2A39; /* Deep Navy */
        }
        .pricing-card .annual-text {
            font-size: 14px;
            color: #1C2A39; /* Deep Navy */
            margin-top: 4px;
            display: none;
        }
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        .pricing-card ul {
            margin-top: 24px;
            list-style: none;
            padding: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
<<<<<<< HEAD
            gap: 12px;
=======
            gap: 16px;
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
        .pricing-card li {
            display: flex;
            align-items: center;
<<<<<<< HEAD
            font-size: 14px;
            color: #1C2A39;
            line-height: 1.4;
        }
        .pricing-card li .check {
            color: #6EE7B7;
            margin-right: 8px;
            font-size: 16px;
            min-width: 16px;
        }

        .pricing-card button {
            margin-top: 24px;
            background-color: #6EE7B7;
            color: #1C2A39;
=======
            font-size: 16px;
            color: #1C2A39; /* Deep Navy */
        }
        .pricing-card li .check {
            color: #6EE7B7; /* Mint Green */
            margin-right: 8px;
            font-size: 20px;
        }
        .pricing-card li.locked {
            color: #1C2A39; /* Deep Navy */
        }
        .pricing-card li.locked svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            fill: #B06F49; /* Muted Copper */
        }
        .pricing-card button {
            margin-top: 24px;
            background-color: #6EE7B7; /* Mint Green */
            color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .pricing-card button:hover {
<<<<<<< HEAD
            background-color: #B06F49;
            color: #F9FAFB;
        }

        /* Testimonials */
        .testimonial {
            margin-top: 16px;
            padding: 12px;
            background-color: rgba(110, 231, 183, 0.1);
            border-radius: 8px;
            border-left: 3px solid #6EE7B7;
        }
        .testimonial .quote {
            font-size: 13px;
            color: #1C2A39;
            font-style: italic;
            line-height: 1.4;
        }
        .testimonial .author {
            font-size: 11px;
            color: #B06F49;
            margin-top: 6px;
            font-weight: 500;
        }

        /* Compare Features Button */
        .compare-features {
            text-align: center;
            margin-top: 32px;
        }
        .compare-features button {
            background-color: #1C2A39;
            color: #F9FAFB;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .compare-features button:hover {
            background-color: #B06F49;
=======
            background-color: #B06F49; /* Muted Copper */
            color: #F9FAFB; /* Light Gray */
        }

        /* Tooltip */
        .tooltip {
            position: relative;
            display: inline-flex;
        }
        .tooltip .tooltip-text {
            visibility: hidden;
            width: 200px;
            background-color: #1C2A39; /* Deep Navy */
            color: #F9FAFB; /* Light Gray */
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 14px;
        }
        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }

        /* Swiper Navigation */
        .swiper-button-next,
        .swiper-button-prev {
<<<<<<< HEAD
            color: #F9FAFB;
            background: #1C2A39;
=======
            color: #F9FAFB; /* Light Gray */
            background: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s;
        }
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
<<<<<<< HEAD
            background: #6EE7B7;
            color: #1C2A39;
=======
            background: #6EE7B7; /* Mint Green */
            color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
        }
        .swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .swiper-button-prev {
            left: 100px;
        }
        .swiper-button-next {
            right: 100px;
        }
        .swiper-pagination {
            margin-top: 20px;
        }
        .swiper-pagination-bullet {
<<<<<<< HEAD
            background: #1C2A39;
        }
        .swiper-pagination-bullet-active {
            background: #6EE7B7;
        }

        /* Additional Info */
        .additional-info {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: #1C2A39;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #F9FAFB;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .close {
            color: #1C2A39;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: #B06F49;
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #1C2A39;
        }
        .comparison-table th {
            background-color: #6EE7B7;
            color: #1C2A39;
            font-weight: 600;
=======
            background: #1C2A39; /* Deep Navy */
        }
        .swiper-pagination-bullet-active {
            background: #6EE7B7; /* Mint Green */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .pricing-box {
                padding: 20px;
<<<<<<< HEAD
            }
            .pricing-header h2 {
                font-size: 28px;
            }
            .pricing-header p {
                font-size: 16px;
=======
                background-color: #F9FAFB; /* Light Gray */
            }
            .pricing-header h2 {
                font-size: 28px;
                color: #1C2A39; /* Deep Navy */
            }
            .pricing-header p {
                font-size: 16px;
                color: #1C2A39; /* Deep Navy */
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            }
            .swiper-button-prev,
            .swiper-button-next {
                display: none;
            }
            .swiper-slide {
                width: 100%;
            }
<<<<<<< HEAD
            .plan-badge {
                font-size: 11px;
                padding: 4px 8px;
            }
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
            .comparison-table {
                font-size: 12px;
            }
=======
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
        }
    </style>
</head>
<body>
    <section class="site-section" id="pricing">
        <div class="container">
            <div class="pricing-box">
                <div class="pricing-header">
                    <h2>Pricing Plans</h2>
<<<<<<< HEAD
                    <p>Flexible and affordable plans tailored to your service business needs. Save up to 20% for a limited time.</p>
=======
                    <p>Flexible and affordable plans tailored to your needs. Save up to 20% for a limited time.</p>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
                </div>

                <!-- Toggle Switch -->
                <div class="tabs-triggers">
                    <button id="monthly-toggle" class="active">Monthly</button>
                    <button id="annual-toggle">Annual <span class="save-badge">Save 20%</span></button>
                </div>

                <!-- Pricing Table -->
                <div class="lqd-tabs-content-wrap">
                    <div class="lqd-tabs-content">
<<<<<<< HEAD
=======
                        <!-- Monthly Pricing -->
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
                        <div id="pricing-monthly">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <!-- Free Trial -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
<<<<<<< HEAD
                                            <div class="plan-badge">💡 Perfect for Testing</div>
                                            <h3>Free Trial</h3>
                                            <p class="price" id="free-price">$0<span>/month</span></p>
                                            
                                            <div class="tokens-info">
                                                <div class="tokens-amount">25K AI Tokens</div>
                                                <div class="tokens-label">Basic AI usage included</div>
                                            </div>

                                            <ul>
                                                <li><span class="check">✔</span> GPT-3.5 Access</li>
                                                <li><span class="check">✔</span> 1 User / 1 Project</li>
                                                <li><span class="check">✔</span> Basic Quote Generator</li>
                                                <li><span class="check">✔</span> Email Support</li>
                                                <li><span class="check">✔</span> 14-Day Trial</li>
                                            </ul>
                                            
                                            <button>Start Free Trial</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"Great way to test before committing to a paid plan."</div>
                                                <div class="author">— Sarah M., House Cleaning Pro</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Starter -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <div class="plan-badge">💡 Best for New Solo Operators</div>
                                            <h3>Starter</h3>
                                            <p class="price" id="starter-price-mobile">$39<span>/month</span></p>
                                            <p class="annual-text" id="starter-annual-mobile">$31.20/month billed annually</p>
                                            
                                            <div class="tokens-info">
                                                <div class="tokens-amount">100K AI Tokens</div>
                                                <div class="tokens-label">~200 quotes or estimates</div>
                                            </div>

                                            <ul>
                                                <li><span class="check">✔</span> GPT-3.5 + Basic Tools</li>
                                                <li><span class="check">✔</span> 1 User / 2 Projects</li>
                                                <li><span class="check">✔</span> CRM: Lite (50 contacts)</li>
                                                <li><span class="check">✔</span> Basic Invoicing</li>
                                                <li><span class="check">✔</span> Priority Support</li>
                                            </ul>
                                            
                                            <button>Start Solo for $39/mo</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"Perfect for my lawn care startup - handles all my quotes!"</div>
                                                <div class="author">— Mike T., Lawn Service Pro (Dallas, TX)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pro -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <div class="plan-badge">🔧 Popular with Growing Service Businesses</div>
                                            <h3>Pro</h3>
                                            <p class="price" id="pro-price-mobile">$79<span>/month</span></p>
                                            <p class="annual-text" id="pro-annual-mobile">$63.20/month billed annually</p>
                                            
                                            <div class="tokens-info">
                                                <div class="tokens-amount">500K AI Tokens</div>
                                                <div class="tokens-label">~1,000 quotes + AI features</div>
                                            </div>

                                            <ul>
                                                <li><span class="check">✔</span> GPT-4o + Claude Access</li>
                                                <li><span class="check">✔</span> Up to 3 Users / 10 Projects</li>
                                                <li><span class="check">✔</span> Full CRM (500 contacts)</li>
                                                <li><span class="check">✔</span> Advanced Invoicing + Reports</li>
                                                <li><span class="check">✔</span> Basic eSignature</li>
                                            </ul>
                                            
                                            <button>Grow Your Team – $79/mo</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"I send 20+ quotes a week using NuvokAI — this thing saves hours."</div>
                                                <div class="author">— Marcus R., Plumbing Pro (Tampa, FL)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Premium -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <div class="plan-badge">🚀 For High-Volume Contractors & Agencies</div>
                                            <h3>Premium</h3>
                                            <p class="price" id="premium-price-mobile">$149<span>/month</span></p>
                                            <p class="annual-text" id="premium-annual-mobile">$119.20/month billed annually</p>
                                            
                                            <div class="tokens-info">
                                                <div class="tokens-amount">1.5M AI Tokens</div>
                                                <div class="tokens-label">~3,000 quotes + premium features</div>
                                            </div>

                                            <ul>
                                                <li><span class="check">✔</span> All AI Models + Image Tools</li>
                                                <li><span class="check">✔</span> Up to 15 Users / 50 Projects</li>
                                                <li><span class="check">✔</span> Advanced CRM (Unlimited)</li>
                                                <li><span class="check">✔</span> Full eSignature + Branded Docs</li>
                                                <li><span class="check">✔</span> White-Label Reports</li>
                                            </ul>
                                            
                                            <button>Scale Fast – $149/mo</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"Manages our entire service operation - from leads to invoicing."</div>
                                                <div class="author">— Jessica L., HVAC Agency Owner (Phoenix, AZ)</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Enterprise -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <div class="plan-badge">🏢 Custom AI Solutions for Large Teams</div>
                                            <h3>Enterprise</h3>
                                            <p class="price" id="enterprise-price-mobile">Custom<span></span></p>
                                            <p class="annual-text" id="enterprise-annual-mobile">Contact for pricing</p>
                                            
                                            <div class="tokens-info">
                                                <div class="tokens-amount">4M+ AI Tokens</div>
                                                <div class="tokens-label">Unlimited usage + custom AI</div>
                                            </div>

                                            <ul>
                                                <li><span class="check">✔</span> Custom AI Models + API Access</li>
                                                <li><span class="check">✔</span> 50+ Users / Unlimited Projects</li>
                                                <li><span class="check">✔</span> Enterprise CRM Integration</li>
                                                <li><span class="check">✔</span> White-Label Platform</li>
                                                <li><span class="check">✔</span> Dedicated Account Manager</li>
                                            </ul>
                                            
                                            <button>Let's Build Your AI Stack</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"Completely transformed how we handle 500+ service calls monthly."</div>
                                                <div class="author">— Robert K., Multi-State Contractor</div>
                                            </div>
=======
                                            <h3>Free Trial</h3>
                                            <p class="price" id="free-price">$0<span>/month</span></p>
                                            <ul>
                                                <li><span class="check">✔</span> AI Access: GPT-3.5</li>
                                                <li><span class="check">✔</span> Users / Projects: 1 / 1</li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    CRM <span class="tooltip-text">Upgrade to Starter for CRM access</span>
                                                </li>
                                            </ul>
                                            <button>Get Started</button>
                                        </div>
                                    </div>
                                    <!-- Starter -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <h3>Starter</h3>
                                            <p class="price" id="starter-price-mobile">$39<span>/month</span></p>
                                            <p class="annual-text" id="starter-annual-mobile">$31.20/month billed annually</p>
                                            <ul>
                                                <li><span class="check">✔</span> AI Access: GPT-3.5</li>
                                                <li><span class="check">✔</span> Users / Projects: 1 / 2</li>
                                                <li><span class="check">✔</span> CRM: Lite</li>
                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Basic</li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    eSignature <span class="tooltip-text">Upgrade to Pro for eSignature</span>
                                                </li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    TTS HD / Image2Video <span class="tooltip-text">Upgrade to Premium for TTS HD</span>
                                                </li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>
                                                </li>
                                            </ul>
                                            <button>Get Started</button>
                                        </div>
                                    </div>
                                    <!-- Pro -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <h3>Pro</h3>
                                            <p class="price" id="pro-price-mobile">$79<span>/month</span></p>
                                            <p class="annual-text" id="pro-annual-mobile">$63.20/month billed annually</p>
                                            <ul>
                                                <li><span class="check">✔</span> AI Access: GPT-4o, Claude</li>
                                                <li><span class="check">✔</span> Users / Projects: 5 / 10</li>
                                                <li><span class="check">✔</span> CRM: Full</li>
                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Full</li>
                                                <li><span class="check">✔</span> eSignature: Basic</li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    TTS HD / Image2Video <span class="tooltip-text">Upgrade to Premium for TTS HD</span>
                                                </li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>
                                                </li>
                                            </ul>
                                            <button>Get Started</button>
                                        </div>
                                    </div>
                                    <!-- Premium -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <h3>Premium</h3>
                                            <p class="price" id="premium-price-mobile">$149<span>/month</span></p>
                                            <p class="annual-text" id="premium-annual-mobile">$119.20/month billed annually</p>
                                            <ul>
                                                <li><span class="check">✔</span> AI Access: All AI</li>
                                                <li><span class="check">✔</span> Users / Projects: 15 / 50</li>
                                                <li><span class="check">✔</span> CRM: Full</li>
                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Full + Reports</li>
                                                <li><span class="check">✔</span> eSignature: Full</li>
                                                <li><span class="check">✔</span> TTS HD / Image2Video</li>
                                                <li class="locked tooltip">
                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>
                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>
                                                </li>
                                            </ul>
                                            <button>Get Started</button>
                                        </div>
                                    </div>
                                    <!-- Enterprise -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <h3>Enterprise</h3>
                                            <p class="price" id="enterprise-price-mobile">Custom<span></span></p>
                                            <p class="annual-text" id="enterprise-annual-mobile">Contact for pricing</p>
                                            <ul>
                                                <li><span class="check">✔</span> AI Access: API & Custom AI</li>
                                                <li><span class="check">✔</span> Users / Projects: 50+ / Unlimited</li>
                                                <li><span class="check">✔</span> CRM: API Sync</li>
                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Advanced Sync</li>
                                                <li><span class="check">✔</span> eSignature: Bulk & Branded</li>
                                                <li><span class="check">✔</span> TTS HD / Image2Video</li>
                                                <li><span class="check">✔</span> API Access / White-Labeling</li>
                                            </ul>
                                            <button>Contact Us</button>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
                                        </div>
                                    </div>
                                </div>
                                <!-- Swiper Pagination -->
                                <div class="swiper-pagination"></div>
                                <!-- Swiper Navigation Buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
<<<<<<< HEAD
                    </div>
                </div>

                <!-- Compare Features Button -->
                <div class="compare-features">
                    <button onclick="showFeatureComparison()">📊 See Full Feature Comparison</button>
                </div>

                <!-- Additional Info -->
                <div class="additional-info">
                    Additional usage: $0.015 per 1K tokens | All plans include 24/7 support
                </div>
=======
                        <!-- Annual Pricing (Hidden by default) -->
                        <div id="pricing-annual" class="hidden">
                            <!-- Replicate monthly pricing structure with annual prices -->
                        </div>
                    </div>
                </div>
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            </div>
        </div>
    </section>

<<<<<<< HEAD
    <!-- Feature Comparison Modal -->
    <div id="featureModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Complete Feature Comparison</h2>
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Feature</th>
                        <th>Free Trial</th>
                        <th>Starter</th>
                        <th>Pro</th>
                        <th>Premium</th>
                        <th>Enterprise</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AI Tokens/Month</td>
                        <td>25K</td>
                        <td>100K</td>
                        <td>500K</td>
                        <td>1.5M</td>
                        <td>4M+</td>
                    </tr>
                    <tr>
                        <td>AI Models</td>
                        <td>GPT-3.5</td>
                        <td>GPT-3.5</td>
                        <td>GPT-4o, Claude</td>
                        <td>All AI Models</td>
                        <td>Custom AI + API</td>
                    </tr>
                    <tr>
                        <td>Users</td>
                        <td>1</td>
                        <td>1</td>
                        <td>3</td>
                        <td>15</td>
                        <td>50+</td>
                    </tr>
                    <tr>
                        <td>Projects</td>
                        <td>1</td>
                        <td>2</td>
                        <td>10</td>
                        <td>50</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td>CRM Contacts</td>
                        <td>10</td>
                        <td>50</td>
                        <td>500</td>
                        <td>Unlimited</td>
                        <td>Enterprise Sync</td>
                    </tr>
                    <tr>
                        <td>eSignature</td>
                        <td>❌</td>
                        <td>❌</td>
                        <td>Basic</td>
                        <td>Full + Branded</td>
                        <td>Bulk + Branded</td>
                    </tr>
                    <tr>
                        <td>Support Level</td>
                        <td>Email</td>
                        <td>Priority</td>
                        <td>Priority</td>
                        <td>Premium</td>
                        <td>Dedicated Manager</td>
                    </tr>
                    <tr>
                        <td>White-Labeling</td>
                        <td>❌</td>
                        <td>❌</td>
                        <td>❌</td>
                        <td>Reports Only</td>
                        <td>Full Platform</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

=======
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM fully loaded. Initializing Swiper...');

<<<<<<< HEAD
=======
            // Check if Swiper is defined
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            if (typeof Swiper === 'undefined') {
                console.error('Swiper is not defined. Check if Swiper script is loaded correctly.');
                return;
            }

<<<<<<< HEAD
=======
            // Initialize Swiper
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            try {
                const swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 20,
                            centeredSlides: false,
                        },
                    },
                    on: {
                        init: function () {
                            console.log('Swiper initialized successfully. Slides:', this.slides.length);
                        },
                        slideChange: function () {
                            console.log('Swiper slide changed. Current index:', this.activeIndex);
                        },
                    },
                });
            } catch (error) {
                console.error('Error initializing Swiper:', error);
            }

            // Toggle between Monthly and Annual pricing
            const monthlyToggle = document.getElementById('monthly-toggle');
            const annualToggle = document.getElementById('annual-toggle');
            const starterPriceMobile = document.getElementById('starter-price-mobile');
            const starterAnnualMobile = document.getElementById('starter-annual-mobile');
            const proPriceMobile = document.getElementById('pro-price-mobile');
            const proAnnualMobile = document.getElementById('pro-annual-mobile');
            const premiumPriceMobile = document.getElementById('premium-price-mobile');
            const premiumAnnualMobile = document.getElementById('premium-annual-mobile');

            function showMonthly() {
                console.log('Switching to monthly pricing.');
                document.querySelector('.lqd-tabs-content-wrap').classList.remove('annual-active');
                monthlyToggle.classList.add('active');
                annualToggle.classList.remove('active');

                if (starterPriceMobile) starterPriceMobile.innerHTML = '$39<span>/month</span>';
                if (proPriceMobile) proPriceMobile.innerHTML = '$79<span>/month</span>';
                if (premiumPriceMobile) premiumPriceMobile.innerHTML = '$149<span>/month</span>';

                if (starterAnnualMobile) starterAnnualMobile.style.display = 'none';
                if (proAnnualMobile) proAnnualMobile.style.display = 'none';
                if (premiumAnnualMobile) premiumAnnualMobile.style.display = 'none';
            }

            function showAnnual() {
                console.log('Switching to annual pricing.');
                document.querySelector('.lqd-tabs-content-wrap').classList.add('annual-active');
                annualToggle.classList.add('active');
                monthlyToggle.classList.remove('active');

                if (starterPriceMobile) starterPriceMobile.innerHTML = '$31.20<span>/month</span>';
                if (proPriceMobile) proPriceMobile.innerHTML = '$63.20<span>/month</span>';
                if (premiumPriceMobile) premiumPriceMobile.innerHTML = '$119.20<span>/month</span>';

                if (starterAnnualMobile) starterAnnualMobile.style.display = 'block';
                if (proAnnualMobile) proAnnualMobile.style.display = 'block';
                if (premiumAnnualMobile) premiumAnnualMobile.style.display = 'block';
            }

            if (monthlyToggle) {
                monthlyToggle.addEventListener('click', showMonthly);
            }
            if (annualToggle) {
                annualToggle.addEventListener('click', showAnnual);
            }

<<<<<<< HEAD
            showMonthly();

=======
            // Initialize with monthly pricing
            showMonthly();

            // Add lqd-is-in-view class when section is in viewport
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
            const pricingSection = document.getElementById('pricing');
            if (pricingSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            console.log('Pricing section is in viewport.');
                            pricingSection.classList.add('lqd-is-in-view');
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(pricingSection);
            }
        });
<<<<<<< HEAD

        // Feature Comparison Modal
        function showFeatureComparison() {
            document.getElementById('featureModal').style.display = 'block';
        }

        // Close modal when clicking the X
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('close')) {
                document.getElementById('featureModal').style.display = 'none';
            }
        });

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('featureModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
=======
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
    </script>
</body>
</html>


<<<<<<< HEAD
=======



<!--first code-->
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Pricing Plans</title>-->
    
    <!-- Load Swiper CSS -->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />-->
    
    <!-- Load Swiper JS -->
<!--    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>-->

<!--    <style>-->
<!--        body {-->
<!--            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;-->
<!--            background-color: #f3f4f6;-->
<!--            margin: 0;-->
<!--            padding: 0;-->
<!--        }-->

<!--        .site-section {-->
<!--            padding: 40px 0;-->
<!--            transition: transform 0.7s, opacity 0.7s;-->
<!--        }-->
<!--        .site-section:not(.lqd-is-in-view) {-->
<!--            transform: translateY(32px);-->
<!--            opacity: 0;-->
<!--        }-->
<!--        .site-section.lqd-is-in-view {-->
<!--            transform: translateY(0);-->
<!--            opacity: 1;-->
<!--        }-->

<!--        .container {-->
<!--            max-width: 1200px;-->
<!--            margin: 0 auto;-->
<!--            padding: 0 16px;-->
<!--        }-->

<!--        .pricing-box {-->
            <!--/*background-color: #ffffff;*/-->
<!--            border: 1px solid #e5e7eb;-->
<!--            border-radius: 32px;-->
<!--            padding: 44px;-->
<!--        }-->

<!--        .pricing-header {-->
<!--            text-align: center;-->
<!--            margin-bottom: 28px;-->
<!--        }-->
<!--        .pricing-header h2 {-->
<!--            font-size: 36px;-->
<!--            font-weight: 700;-->
<!--            color: #1f2937;-->
<!--            margin: 0;-->
<!--        }-->
<!--        .pricing-header p {-->
<!--            font-size: 18px;-->
<!--            color: #6b7280;-->
<!--            margin-top: 8px;-->
<!--        }-->

        <!--/* Toggle Switch */-->
<!--        .tabs-triggers {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            gap: 8px;-->
<!--            margin-bottom: 36px;-->
<!--        }-->
<!--        .tabs-triggers button {-->
<!--            padding: 8px 16px;-->
<!--            font-size: 15px;-->
<!--            font-weight: 500;-->
<!--            border: 1px solid #e5e7eb;-->
<!--            border-radius: 8px;-->
<!--            background-color: #f3f4f6;-->
<!--            color: #6b7280;-->
<!--            cursor: pointer;-->
<!--            transition: background-color 0.3s, color 0.3s;-->
<!--        }-->
<!--        .tabs-triggers button.active {-->
<!--            background-color: #ffffff;-->
<!--            color: #1f2937;-->
<!--        }-->
<!--        .tabs-triggers .save-badge {-->
<!--            margin-left: 4px;-->
<!--            font-size: 12px;-->
<!--            background-color: #75d575;-->
<!--            color: #ffffff;-->
<!--            padding: 4px 8px;-->
<!--            border-radius: 4px;-->
<!--        }-->

        <!--/* Swiper Container */-->
<!--        .swiper-container {-->
<!--            width: 100%;-->
<!--            max-width: 960px;-->
<!--            margin: 0 auto;-->
<!--            padding: 0 10px;-->
<!--            overflow: hidden;-->
<!--        }-->
<!--        .swiper-slide {-->
<!--            display: flex;-->
<!--            justify-content: center;-->
<!--            width: 300px;-->
<!--            box-sizing: border-box;-->
<!--        }-->

        <!--/* Pricing Card */-->
<!--        .lqd-tabs-content-wrap {-->
<!--            --pricing-card-height: 572px;-->
<!--        }-->
<!--        .lqd-tabs-content-wrap.annual-active {-->
<!--            --pricing-card-height: 595px;-->
<!--        }-->
<!--        .pricing-card {-->
<!--            background-color: #F3F4F6;-->
<!--            border-radius: 12px;-->
<!--            padding: 24px;-->
<!--            display: flex;-->
<!--            flex-direction: column;-->
<!--            min-height: var(--pricing-card-height);-->
<!--            width: 100%;-->
<!--        }-->
<!--        .pricing-card h3 {-->
<!--            font-size: 20px;-->
<!--            font-weight: 600;-->
<!--            color: #1f2937;-->
<!--            margin: 0;-->
<!--        }-->
<!--        .pricing-card .price {-->
<!--            font-size: 30px;-->
<!--            font-weight: 700;-->
<!--            color: #1f2937;-->
<!--            margin-top: 16px;-->
<!--        }-->
<!--        .pricing-card .price span {-->
<!--            font-size: 16px;-->
<!--            font-weight: 400;-->
<!--        }-->
<!--        .pricing-card .annual-text {-->
<!--            font-size: 14px;-->
<!--            color: #6b7280;-->
<!--            margin-top: 4px;-->
<!--            display: none;-->
<!--        }-->
<!--        .pricing-card ul {-->
<!--            margin-top: 24px;-->
<!--            list-style: none;-->
<!--            padding: 0;-->
<!--            flex-grow: 1;-->
<!--            display: flex;-->
<!--            flex-direction: column;-->
<!--            gap: 16px;-->
<!--        }-->
<!--        .pricing-card li {-->
<!--            display: flex;-->
<!--            align-items: center;-->
<!--            font-size: 16px;-->
<!--            color: #1f2937;-->
<!--        }-->
<!--        .pricing-card li .check {-->
<!--            color: #22c55e;-->
<!--            margin-right: 8px;-->
<!--            font-size: 20px;-->
<!--        }-->
<!--        .pricing-card li.locked {-->
<!--            color: #6b7280;-->
<!--        }-->
<!--        .pricing-card li.locked svg {-->
<!--            width: 20px;-->
<!--            height: 20px;-->
<!--            margin-right: 8px;-->
<!--            fill: #6b7280;-->
<!--        }-->
<!--        .pricing-card button {-->
<!--            margin-top: 24px;-->
            <!--/*background-color: #66707F;*/-->
<!--            color: #66707F;-->
<!--            padding: 12px;-->
<!--            border-radius: 8px;-->
<!--            border: none;-->
<!--            font-size: 16px;-->
<!--            font-weight: 500;-->
<!--            cursor: pointer;-->
<!--            transition: background-color 0.3s;-->
<!--        }-->
<!--        .pricing-card button:hover {-->
<!--            background-color: #66707f0f;-->
<!--        }-->

        <!--/* Tooltip */-->
<!--        .tooltip {-->
<!--            position: relative;-->
<!--            display: inline-flex;-->
<!--        }-->
<!--        .tooltip .tooltip-text {-->
<!--            visibility: hidden;-->
<!--            width: 200px;-->
<!--            background-color: #1f2937;-->
<!--            color: #fff;-->
<!--            text-align: center;-->
<!--            border-radius: 6px;-->
<!--            padding: 8px;-->
<!--            position: absolute;-->
<!--            z-index: 10;-->
<!--            bottom: 125%;-->
<!--            left: 50%;-->
<!--            transform: translateX(-50%);-->
<!--            opacity: 0;-->
<!--            transition: opacity 0.3s;-->
<!--            font-size: 14px;-->
<!--        }-->
<!--        .tooltip:hover .tooltip-text {-->
<!--            visibility: visible;-->
<!--            opacity: 1;-->
<!--        }-->

        <!--/* Swiper Navigation */-->
<!--        .swiper-button-next,-->
<!--        .swiper-button-prev {-->
<!--            color: #ffffff;-->
<!--            background: #1f2937;-->
<!--            border-radius: 50%;-->
<!--            width: 40px;-->
<!--            height: 40px;-->
<!--            display: flex;-->
<!--            align-items: center;-->
<!--            justify-content: center;-->
<!--            transition: opacity 0.3s;-->
<!--        }-->
<!--        .swiper-button-next:after,-->
<!--        .swiper-button-prev:after {-->
<!--            font-size: 20px;-->
<!--        }-->
<!--        .swiper-button-disabled {-->
<!--            opacity: 0.3;-->
<!--            cursor: not-allowed;-->
<!--        }-->
<!--        .swiper-button-prev {-->
<!--            left: 100px;-->
<!--        }-->
<!--        .swiper-button-next {-->
<!--            right: 100px;-->
<!--        }-->
<!--        .swiper-pagination {-->
<!--            margin-top: 20px;-->
<!--        }-->

        <!--/* Responsive Design */-->
<!--        @media (max-width: 767px) {-->
<!--            .pricing-box {-->
<!--                padding: 20px;-->
<!--            }-->
<!--            .pricing-header h2 {-->
<!--                font-size: 28px;-->
<!--            }-->
<!--            .pricing-header p {-->
<!--                font-size: 16px;-->
<!--            }-->
<!--            .swiper-button-prev,-->
<!--            .swiper-button-next {-->
<!--                display: none;-->
<!--            }-->
<!--            .swiper-slide {-->
<!--                width: 100%;-->
<!--            }-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--    <section class="site-section" id="pricing">-->
<!--        <div class="container">-->
<!--            <div class="pricing-box">-->
<!--                <div class="pricing-header">-->
<!--                    <h2>Pricing Plans</h2>-->
<!--                    <p>Flexible and affordable plans tailored to your needs. Save up to 20% for a limited time.</p>-->
<!--                </div>-->

                <!-- Toggle Switch -->
<!--                <div class="tabs-triggers">-->
<!--                    <button id="monthly-toggle" class="active">Monthly</button>-->
<!--                    <button id="annual-toggle">Annual <span class="save-badge">Save 20%</span></button>-->
<!--                </div>-->

                <!-- Pricing Table -->
<!--                <div class="lqd-tabs-content-wrap">-->
<!--                    <div class="lqd-tabs-content">-->
                        <!-- Monthly Pricing -->
<!--                        <div id="pricing-monthly">-->
<!--                            <div class="swiper-container">-->
<!--                                <div class="swiper-wrapper">-->
                                    <!-- Free Trial -->
<!--                                    <div class="swiper-slide">-->
<!--                                        <div class="pricing-card">-->
<!--                                            <h3>Free Trial</h3>-->
<!--                                            <p class="price" id="free-price">$0<span>/month</span></p>-->
<!--                                            <ul>-->
<!--                                                <li><span class="check">✔</span> AI Access: GPT-3.5</li>-->
<!--                                                <li><span class="check">✔</span> Users / Projects: 1 / 1</li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    CRM <span class="tooltip-text">Upgrade to Starter for CRM access</span>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                            <button>Get Started</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <!-- Starter -->
<!--                                    <div class="swiper-slide">-->
<!--                                        <div class="pricing-card">-->
<!--                                            <h3>Starter</h3>-->
<!--                                            <p class="price" id="starter-price-mobile">$39<span>/month</span></p>-->
<!--                                            <p class="annual-text" id="starter-annual-mobile">$31.20/month billed annually</p>-->
<!--                                            <ul>-->
<!--                                                <li><span class="check">✔</span> AI Access: GPT-3.5</li>-->
<!--                                                <li><span class="check">✔</span> Users / Projects: 1 / 2</li>-->
<!--                                                <li><span class="check">✔</span> CRM: Lite</li>-->
<!--                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Basic</li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    eSignature <span class="tooltip-text">Upgrade to Pro for eSignature</span>-->
<!--                                                </li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    TTS HD / Image2Video <span class="tooltip-text">Upgrade to Premium for TTS HD</span>-->
<!--                                                </li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                            <button>Get Started</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <!-- Pro -->
<!--                                    <div class="swiper-slide">-->
<!--                                        <div class="pricing-card">-->
<!--                                            <h3>Pro</h3>-->
<!--                                            <p class="price" id="pro-price-mobile">$79<span>/month</span></p>-->
<!--                                            <p class="annual-text" id="pro-annual-mobile">$63.20/month billed annually</p>-->
<!--                                            <ul>-->
<!--                                                <li><span class="check">✔</span> AI Access: GPT-4o, Claude</li>-->
<!--                                                <li><span class="check">✔</span> Users / Projects: 5 / 10</li>-->
<!--                                                <li><span class="check">✔</span> CRM: Full</li>-->
<!--                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Full</li>-->
<!--                                                <li><span class="check">✔</span> eSignature: Basic</li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    TTS HD / Image2Video <span class="tooltip-text">Upgrade to Premium for TTS HD</span>-->
<!--                                                </li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                            <button>Get Started</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <!-- Premium -->
<!--                                    <div class="swiper-slide">-->
<!--                                        <div class="pricing-card">-->
<!--                                            <h3>Premium</h3>-->
<!--                                            <p class="price" id="premium-price-mobile">$149<span>/month</span></p>-->
<!--                                            <p class="annual-text" id="premium-annual-mobile">$119.20/month billed annually</p>-->
<!--                                            <ul>-->
<!--                                                <li><span class="check">✔</span> AI Access: All AI</li>-->
<!--                                                <li><span class="check">✔</span> Users / Projects: 15 / 50</li>-->
<!--                                                <li><span class="check">✔</span> CRM: Full</li>-->
<!--                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Full + Reports</li>-->
<!--                                                <li><span class="check">✔</span> eSignature: Full</li>-->
<!--                                                <li><span class="check">✔</span> TTS HD / Image2Video</li>-->
<!--                                                <li class="locked tooltip">-->
<!--                                                    <svg viewBox="0 0 13 18"><path d="M10.346 6.323H4.024V3.449C4.024 2.839 4.26632 2.25399 4.69765 1.82266C5.12899 1.39132 5.714 1.149 6.324 1.149C6.934 1.149 7.51901 1.39132 7.95035 1.82266C8.38168 2.25399 8.624 2.839 8.624 3.449C8.624 3.6015 8.68458 3.74775 8.79241 3.85559C8.90025 3.96342 9.0465 4.024 9.199 4.024C9.3515 4.024 9.49775 3.96342 9.60558 3.85559C9.71342 3.74775 9.774 3.6015 9.774 3.449C9.774 2.534 9.41052 1.65648 8.76352 1.00948C8.11652 0.362482 7.23899 -0.000999451 6.324 -0.000999451C5.409 -0.000999451 4.53148 0.362482 3.88448 1.00948C3.23748 1.65648 2.874 2.534 2.874 3.449V6.323H2.3C1.69001 6.323 1.10499 6.56532 0.673653 6.99666C0.242319 7.42799 0 8.013 0 8.623V14.946C0 15.248 0.0594935 15.5471 0.175079 15.8262C0.290665 16.1052 0.460078 16.3588 0.673653 16.5723C0.887227 16.7859 1.14078 16.9553 1.41983 17.0709C1.69888 17.1865 1.99796 17.246 2.3 17.246H10.347C10.649 17.246 10.9481 17.1865 11.2272 17.0709C11.5062 16.9553 11.7598 16.7859 11.9733 16.5723C12.1869 16.3588 12.3563 16.1052 12.4719 15.8262C12.5875 15.2471 12.647 15.248 12.647 14.946V8.622C12.6469 8.31996 12.5872 8.0209 12.4715 7.7419C12.3558 7.46291 12.1863 7.20943 11.9726 6.99595C11.759 6.78247 11.5053 6.61316 11.2262 6.49769C10.9472 6.38223 10.648 6.32287 10.346 6.323Z"></path></svg>-->
<!--                                                    API Access / White-Labeling <span class="tooltip-text">Upgrade to Enterprise for API Access</span>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                            <button>Get Started</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <!-- Enterprise -->
<!--                                    <div class="swiper-slide">-->
<!--                                        <div class="pricing-card">-->
<!--                                            <h3>Enterprise</h3>-->
<!--                                            <p class="price" id="enterprise-price-mobile">Custom<span></span></p>-->
<!--                                            <p class="annual-text" id="enterprise-annual-mobile">Contact for pricing</p>-->
<!--                                            <ul>-->
<!--                                                <li><span class="check">✔</span> AI Access: API & Custom AI</li>-->
<!--                                                <li><span class="check">✔</span> Users / Projects: 50+ / Unlimited</li>-->
<!--                                                <li><span class="check">✔</span> CRM: API Sync</li>-->
<!--                                                <li><span class="check">✔</span> Invoicing & Bookkeeping: Advanced Sync</li>-->
<!--                                                <li><span class="check">✔</span> eSignature: Bulk & Branded</li>-->
<!--                                                <li><span class="check">✔</span> TTS HD / Image2Video</li>-->
<!--                                                <li><span class="check">✔</span> API Access / White-Labeling</li>-->
<!--                                            </ul>-->
<!--                                            <button>Contact Us</button>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <!-- Swiper Pagination -->
<!--                                <div class="swiper-pagination"></div>-->
                                <!-- Swiper Navigation Buttons -->
<!--                                <div class="swiper-button-prev"></div>-->
<!--                                <div class="swiper-button-next"></div>-->
<!--                            </div>-->
<!--                        </div>-->
                        <!-- Annual Pricing (Hidden by default) -->
<!--                        <div id="pricing-annual" class="hidden">-->
                            <!-- Replicate monthly pricing structure with annual prices -->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

<!--    <script>-->
<!--        document.addEventListener('DOMContentLoaded', function () {-->
<!--            console.log('DOM fully loaded. Initializing Swiper...');-->

            <!--// Check if Swiper is defined-->
<!--            if (typeof Swiper === 'undefined') {-->
<!--                console.error('Swiper is not defined. Check if Swiper script is loaded correctly.');-->
<!--                return;-->
<!--            }-->

            <!--// Initialize Swiper-->
<!--            try {-->
<!--                const swiper = new Swiper('.swiper-container', {-->
<!--                    slidesPerView: 1,-->
<!--                    spaceBetween: 10,-->
<!--                    pagination: {-->
<!--                        el: '.swiper-pagination',-->
<!--                        clickable: true,-->
<!--                    },-->
<!--                    navigation: {-->
<!--                        nextEl: '.swiper-button-next',-->
<!--                        prevEl: '.swiper-button-prev',-->
<!--                    },-->
<!--                    breakpoints: {-->
<!--                        768: {-->
<!--                            slidesPerView: 3,-->
<!--                            spaceBetween: 20,-->
<!--                            centeredSlides: false,-->
<!--                        },-->
<!--                    },-->
<!--                    on: {-->
<!--                        init: function () {-->
<!--                            console.log('Swiper initialized successfully. Slides:', this.slides.length);-->
<!--                        },-->
<!--                        slideChange: function () {-->
<!--                            console.log('Swiper slide changed. Current index:', this.activeIndex);-->
<!--                        },-->
<!--                    },-->
<!--                });-->
<!--            } catch (error) {-->
<!--                console.error('Error initializing Swiper:', error);-->
<!--            }-->

            <!--// Toggle between Monthly and Annual pricing-->
<!--            const monthlyToggle = document.getElementById('monthly-toggle');-->
<!--            const annualToggle = document.getElementById('annual-toggle');-->
<!--            const starterPriceMobile = document.getElementById('starter-price-mobile');-->
<!--            const starterAnnualMobile = document.getElementById('starter-annual-mobile');-->
<!--            const proPriceMobile = document.getElementById('pro-price-mobile');-->
<!--            const proAnnualMobile = document.getElementById('pro-annual-mobile');-->
<!--            const premiumPriceMobile = document.getElementById('premium-price-mobile');-->
<!--            const premiumAnnualMobile = document.getElementById('premium-annual-mobile');-->

<!--            function showMonthly() {-->
<!--                console.log('Switching to monthly pricing.');-->
<!--                document.querySelector('.lqd-tabs-content-wrap').classList.remove('annual-active');-->
<!--                monthlyToggle.classList.add('active');-->
<!--                annualToggle.classList.remove('active');-->

<!--                if (starterPriceMobile) starterPriceMobile.innerHTML = '$39<span>/month</span>';-->
<!--                if (proPriceMobile) proPriceMobile.innerHTML = '$79<span>/month</span>';-->
<!--                if (premiumPriceMobile) premiumPriceMobile.innerHTML = '$149<span>/month</span>';-->

<!--                if (starterAnnualMobile) starterAnnualMobile.style.display = 'none';-->
<!--                if (proAnnualMobile) proAnnualMobile.style.display = 'none';-->
<!--                if (premiumAnnualMobile) premiumAnnualMobile.style.display = 'none';-->
<!--            }-->

<!--            function showAnnual() {-->
<!--                console.log('Switching to annual pricing.');-->
<!--                document.querySelector('.lqd-tabs-content-wrap').classList.add('annual-active');-->
<!--                annualToggle.classList.add('active');-->
<!--                monthlyToggle.classList.remove('active');-->

<!--                if (starterPriceMobile) starterPriceMobile.innerHTML = '$31.20<span>/month</span>';-->
<!--                if (proPriceMobile) proPriceMobile.innerHTML = '$63.20<span>/month</span>';-->
<!--                if (premiumPriceMobile) premiumPriceMobile.innerHTML = '$119.20<span>/month</span>';-->

<!--                if (starterAnnualMobile) starterAnnualMobile.style.display = 'block';-->
<!--                if (proAnnualMobile) proAnnualMobile.style.display = 'block';-->
<!--                if (premiumAnnualMobile) premiumAnnualMobile.style.display = 'block';-->
<!--            }-->

<!--            if (monthlyToggle) {-->
<!--                monthlyToggle.addEventListener('click', showMonthly);-->
<!--            }-->
<!--            if (annualToggle) {-->
<!--                annualToggle.addEventListener('click', showAnnual);-->
<!--            }-->

            <!--// Initialize with monthly pricing-->
<!--            showMonthly();-->

            <!--// Add lqd-is-in-view class when section is in viewport-->
<!--            const pricingSection = document.getElementById('pricing');-->
<!--            if (pricingSection) {-->
<!--                const observer = new IntersectionObserver((entries) => {-->
<!--                    entries.forEach(entry => {-->
<!--                        if (entry.isIntersecting) {-->
<!--                            console.log('Pricing section is in viewport.');-->
<!--                            pricingSection.classList.add('lqd-is-in-view');-->
<!--                        }-->
<!--                    });-->
<!--                }, { threshold: 0.1 });-->
<!--                observer.observe(pricingSection);-->
<!--            }-->
<!--        });-->
<!--    </script>-->
<!--</body>-->
<!--</html>-->
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
