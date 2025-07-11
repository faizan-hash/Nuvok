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
            background-color: #F9FAFB;
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
            border: 1px solid #1C2A39;
            border-radius: 32px;
            padding: 44px;
            background-color: #F9FAFB;
        }

        .pricing-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .pricing-header h2 {
            font-size: 36px;
            font-weight: 700;
            color: #1C2A39;
            margin: 0;
        }
        .pricing-header p {
            font-size: 18px;
            color: #1C2A39;
            margin-top: 8px;
        }

        /* Toggle Switch */
        /*.tabs-triggers {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 36px;
        }
        .tabs-triggers button {
            padding: 8px 16px;
            font-size: 15px;
            font-weight: 500;
            border: 1px solid #1C2A39;
            border-radius: 8px;
            background-color: #F9FAFB;
            color: #1C2A39;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .tabs-triggers button.active {
            background-color: #6EE7B7;
            color: #1C2A39;
            border-color: #6EE7B7;
        }
        .tabs-triggers .save-badge {
            margin-left: 4px;
            font-size: 12px;
            background-color: #B06F49;
            color: #F9FAFB;
            padding: 4px 8px;
            border-radius: 4px;
        }*/

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
            padding-top: 20px;
        }

        /* Pricing Card */
        .lqd-tabs-content-wrap {
            --pricing-card-height: 650px;
        }
        /*.lqd-tabs-content-wrap.annual-active {
            --pricing-card-height: 675px;
        }*/
        .pricing-card {
            background-color: #F9FAFB;
            border: 1px solid #1C2A39;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            min-height: var(--pricing-card-height);
            width: 100%;
            transition: transform 0.3s;
            position: relative;
        }
        .pricing-card:hover {
            transform: translateY(-4px);
            border-color: #6EE7B7;
        }

        /* Plan Badge */
        .plan-badge {
            position: absolute;
            top: 5px;
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
            margin: 34px 0 0 0;
            text-align: center;
        }
        .pricing-card .price {
            font-size: 30px;
            font-weight: 700;
            color: #1C2A39;
            margin-top: 16px;
            text-align: center;
        }
        .pricing-card .price span {
            font-size: 16px;
            font-weight: 400;
            color: #1C2A39;
        }
        /*.pricing-card .annual-text {
            font-size: 14px;
            color: #1C2A39;
            margin-top: 4px;
            display: none;
            text-align: center;
        }*/

        /* AI Tokens Display */
        .tokens-info {
            background-color: #6EE7B7;
            border-radius: 8px;
            padding: 12px;
            margin: 16px 0;
            text-align: center;
            position: relative;
        }
        .tokens-info .tokens-amount {
            font-size: 18px;
            font-weight: 600;
            color: #1C2A39;
            cursor: pointer;
        }
        .tokens-info .tokens-label {
            font-size: 12px;
            color: #1C2A39;
            margin-top: 4px;
        }
        .tokens-info .tokens-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            background-color: rgba(28, 42, 57, 0.9);
            color: #F9FAFB;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: normal;
            word-wrap: break-word;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 10;
            max-width: 320px;
        }
        .tokens-info:hover .tokens-tooltip {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(70%);
        }

        .pricing-card ul {
            margin-top: 24px;
            list-style: none;
            padding: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .pricing-card li {
            display: flex;
            align-items: center;
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
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .pricing-card button:hover {
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
        }
        .compare-features-text {
            font-size: 14px;
            color: #1C2A39;
            opacity: 0.7;
            margin-top: 8px;
        }

        /* Swiper Navigation */
        .swiper-button-next,
        .swiper-button-prev {
            color: #F9FAFB;
            background: #1C2A39;
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
            background: #6EE7B7;
            color: #1C2A39;
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
            max-width: 900px;
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
        .modal-description {
            margin-top: 8px;
            margin-bottom: 20px;
            color: #1C2A39;
            opacity: 0.8;
            font-size: 16px;
        }
        .modal-note {
            font-size: 14px;
            color: #B06F49;
            margin-bottom: 15px;
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 13px;
        }
        .overflow-x-auto {
            overflow-x: initial;
            max-width: 100%;
            -webkit-overflow-scrolling: auto;
        }
        .comparison-table th,
        .comparison-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid rgba(28, 42, 57, 0.1);
            white-space: normal;
        }
        .comparison-table th {
            background-color: #6EE7B7;
            color: #1C2A39;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 10;
            font-size: 12px;
            text-transform: uppercase;
        }
        .comparison-table th:first-child {
            width: 25%;
        }
        .comparison-table tr:hover {
            background-color: rgba(110, 231, 183, 0.05);
        }
        .comparison-table .category-header {
            background-color: rgba(28, 42, 57, 0.05);
            font-weight: 600;
        }
        .comparison-table .check-icon {
            color: #6EE7B7;
            font-size: 18px;
        }
        .comparison-table .dash-icon {
            color: #B06F49;
        }
        .comparison-table .highlight {
            font-weight: 600;
            color: #B06F49;
        }

        /* Tooltip Styles */
        .tooltip-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .tooltip-container .tooltip-text {
            visibility: hidden;
            width: 220px;
            background-color: #1C2A39;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 8px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position the tooltip above the element */
            left: 50%;
            margin-left: -110px; /* Use half of the width to center */
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tooltip-container:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        .tooltip-container .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%; /* At the bottom of the tooltip */
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #1C2A39 transparent transparent transparent;
        }


        /* Responsive Design */
        @media (max-width: 767px) {
            .pricing-box {
                padding: 20px;
            }
            .pricing-header h2 {
                font-size: 28px;
            }
            .pricing-header p {
                font-size: 16px;
            }
            .swiper-button-prev,
            .swiper-button-next {
                display: none;
            }
            .swiper-slide {
                width: 100%;
            }
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
            .comparison-table th,
            .comparison-table td {
                padding: 8px 4px;
            }
            .modal-description {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <section class="site-section" id="pricing">
        <div class="container">
            <div class="pricing-box">
                <div class="pricing-header">
                    <h2>Pricing Plans</h2>
                    <p>Flexible and affordable plans tailored to your service business needs.</p>
                </div>

                <!-- Toggle Switch removed -->
                

                <!-- Pricing Table -->
                <div class="lqd-tabs-content-wrap">
                    <div class="lqd-tabs-content">
                        <div id="pricing-monthly">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <!-- Free Trial -->
                                    <div class="swiper-slide">
                                        <div class="pricing-card">
                                            <div class="plan-badge">💡 Perfect for Testing</div>
                                            <h3>Free Trial</h3>
                                            <p class="price" id="free-price">$0<span>/month</span></p>
                                            
                                            <div class="tooltip-container" data-tooltip="25K tokens = approx. 3.75K AI words or 7 images or 12 quotes.">
                                                <div class="tokens-info">
                                                    <div class="tokens-amount">25K AI Tokens</div>
                                                    <div class="tokens-label">Basic AI usage included</div>
                                                    <div class="tokens-tooltip">100K tokens = approx. 15K AI words or 30 images or 50 quotes</div>
                                                </div>
                                            </div>

                                            <ul>
                                                <li>👉 GPT-3.5 Access</li>
                                                <li>👉 1 User / 1 Project</li>
                                                <li>👉 Basic Quote Generator</li>
                                                <li>👉 Email Support</li>
                                                <li>👉 14-Day Trial</li>
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
                                            <p class="text-xs text-gray-500 mt-2 text-center">Billed monthly – cancel anytime</p>
                                            
                                            <div class="tooltip-container" data-tooltip="100K tokens = approx. 15K AI words or 30 images or 50 quotes.">
                                                <div class="tokens-info">
                                                    <div class="tokens-amount">100K AI Tokens</div>
                                                    <div class="tokens-label">~200 quotes or estimates</div>
                                                    <div class="tokens-tooltip">100K tokens = approx. 15K AI words or 30 images or 50 quotes</div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Overage: $0.015 / 1K tokens</p>

                                            <ul>
                                                <li>👉 GPT-3.5 + Basic Tools</li>
                                                <li>👉 1 User / 2 Projects</li>
                                                <li>👉 CRM: Lite (50 contacts)</li>
                                                <li>👉 Basic Invoicing</li>
                                                <li>👉 Priority Support</li>
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
                                            <p class="text-xs text-gray-500 mt-2 text-center">Billed monthly – cancel anytime</p>
                                            
                                            <div class="tooltip-container" data-tooltip="500K tokens = approx. 75K AI words or 150 images or 250 quotes.">
                                                <div class="tokens-info">
                                                    <div class="tokens-amount">500K AI Tokens</div>
                                                    <div class="tokens-label">~1,000 quotes + AI features</div>
                                                    <div class="tokens-tooltip">100K tokens = approx. 15K AI words or 30 images or 50 quotes</div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Overage: $0.012 / 1K tokens</p>

                                            <ul>
                                                <li>👉 GPT-4o + Claude Access</li>
                                                <li>👉 Up to 3 Users / 10 Projects</li>
                                                <li>👉 Full CRM (500 contacts)</li>
                                                <li>👉 Advanced Invoicing + Reports</li>
                                                <li>👉 Basic eSignature</li>
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
                                            <p class="text-xs text-gray-500 mt-2 text-center">Billed monthly – cancel anytime</p>
                                            
                                            <div class="tooltip-container" data-tooltip="1.5M tokens = approx. 225K AI words or 450 images or 750 quotes.">
                                                <div class="tokens-info">
                                                    <div class="tokens-amount">1.5M AI Tokens</div>
                                                    <div class="tokens-label">~3,000 quotes + premium features</div>
                                                    <div class="tokens-tooltip">100K tokens = approx. 15K AI words or 30 images or 50 quotes</div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Overage: $0.01 / 1K tokens</p>

                                            <ul>
                                                <li>👉 All AI Models + Image Tools</li>
                                                <li>👉 Up to 15 Users / 50 Projects</li>
                                                <li>👉 Advanced CRM (Unlimited)</li>
                                                <li>👉 Full eSignature + Branded Docs</li>
                                                <li>👉 White-Label Reports</li>
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
                                            <p class="price" id="enterprise-price-mobile">$249<span>/month</span></p>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Billed monthly – cancel anytime</p>
                                            
                                            <div class="tooltip-container" data-tooltip="4M+ tokens = approx. 600K+ AI words or 1200+ images or 2000+ quotes.">
                                                <div class="tokens-info">
                                                    <div class="tokens-amount">4M+ AI Tokens</div>
                                                    <div class="tokens-label">Unlimited usage + custom AI</div>
                                                    <div class="tokens-tooltip">100K tokens = approx. 15K AI words or 30 images or 50 quotes</div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2 text-center">Overage: $0.008 / 1K tokens</p>

                                            <ul>
                                                <li>👉 Custom AI Models + API Access</li>
                                                <li>👉 50+ Users / Unlimited Projects</li>
                                                <li>👉 Enterprise CRM Integration</li>
                                                <li>👉 White-Label Platform</li>
                                                <li>👉 Dedicated Account Manager</li>
                                            </ul>
                                            
                                            <button>Let's Build Your AI Stack</button>
                                            
                                            <div class="testimonial">
                                                <div class="quote">"Completely transformed how we handle 500+ service calls monthly."</div>
                                                <div class="author">— Robert K., Multi-State Contractor</div>
                                            </div>
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
            </div>
        </div>
    </section>

    <!-- Feature Comparison Modal -->
    <div id="featureModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Complete Plan Comparison</h2>
            <p class="modal-description">Compare all features across our pricing plans to find the perfect fit for your needs.</p>
            <div class="overflow-x-auto">
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
                            <td>Monthly Price (USD)</td>
                            <td>$0</td>
                            <td>$39</td>
                            <td>$79</td>
                            <td>$149</td>
                            <td>$249</td>
                        </tr>
                        <tr>
                            <td>Tokens Included</td>
                            <td>25K</td>
                            <td>100K</td>
                            <td>500K</td>
                            <td>1.5M</td>
                            <td>4M+</td>
                        </tr>
                        <tr>
                            <td>Projects Limit</td>
                            <td>1</td>
                            <td>2</td>
                            <td>10</td>
                            <td>50</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Clients Limit</td>
                            <td>1</td>
                            <td>50</td>
                            <td>500</td>
                            <td>Unlimited</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Invoices Limit</td>
                            <td>0</td>
                            <td>5</td>
                            <td>25</td>
                            <td>100</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>GPT Access</td>
                            <td>GPT-3.5</td>
                            <td>GPT-3.5 + Claude</td>
                            <td>GPT-4o + Claude</td>
                            <td>GPT-4o + Claude, DALL-E</td>
                            <td>All AI Models</td>
                        </tr>
                        <tr>
                            <td>Time Tracking + Bookkeeping</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>eSign + Forms</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Image/Video/TTS Tools</td>
                            <td>No</td>
                            <td>Basic</td>
                            <td>Standard</td>
                            <td>HD</td>
                            <td>HD + AI Video</td>
                        </tr>
                        <tr>
                            <td>API Access / White-Label</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes + Custom SLA</td>
                        </tr>
                        <tr>
                            <td>Token Overage Rate ($ per 1K)</td>
                            <td>N/A</td>
                            <td>$0.015</td>
                            <td>$0.012</td>
                            <td>$0.01</td>
                            <td>$0.008</td>
                        </tr>
                        <tr>
                            <td>Team Access</td>
                            <td>-</td>
                            <td>1</td>
                            <td>3</td>
                            <td>10</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td>Support</td>
                            <td>Email Support</td>
                            <td>Priority Support</td>
                            <td>Priority Support</td>
                            <td>Priority Support</td>
                            <td>Priority + VIP Support</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM fully loaded. Initializing Swiper...');

            if (typeof Swiper === 'undefined') {
                console.error('Swiper is not defined. Check if Swiper script is loaded correctly.');
                return;
            }

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

            showMonthly();

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

        // JS for custom tooltip
        document.querySelectorAll('.tooltip-container').forEach(item => {
            const tooltipText = item.getAttribute('data-tooltip');
            const tooltipElement = document.createElement('span');
            tooltipElement.className = 'tooltip-text';
            tooltipElement.innerText = tooltipText;
            item.appendChild(tooltipElement);
        });
    </script>
</body>
</html>


<?php /**PATH /var/www/Novuk/resources/views/default/landing-page/pricing/section.blade.php ENDPATH**/ ?>