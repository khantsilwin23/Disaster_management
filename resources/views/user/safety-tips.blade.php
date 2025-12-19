<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Tips Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f0f4ff, #e6f2ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-title {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .tip-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            overflow: hidden;
            border-radius: 1.25rem;
            background-color: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #e0e7ff;
            margin-bottom: 20px;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .tip-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
        }

        .tip-content {
            padding: 1.2rem;
        }

        .tip-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            color: #1e3a8a;
        }

        .tip-short {
            color: #6b7280;
        }

        .warning {
            color: #dc2626;
            font-weight: 600;
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #fef2f2;
            border-radius: 6px;
            border-left: 3px solid #ef4444;
        }

        .section-heading {
            font-weight: 600;
            color: #1e40af;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            font-size: 1.05rem;
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .header h2 {
            font-weight: 700;
            color: #1e40af;
        }

        /* Detail page styles */
        .detail-page {
            display: none;
            padding: 20px;
        }

        .detail-header {
            margin-bottom: 2rem;
            position: relative;
        }

        .back-button {
            position: absolute;
            left: 0;
            top: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            color: #1e40af;
            display: flex;
            align-items: center;
        }

        .detail-content {
            background-color: #ffffff;
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .detail-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 1.25rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <!-- Dashboard Page -->
        <div id="dashboard-page">
            <div class="header">
                <h2>🛡️ Safety Tips</h2>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Food Safety" data-image="/images/tips/food.jpg">
                        <img src="/images/tips/food.jpg" class="tip-image" alt="Food Safety">
                        <div class="tip-content">
                            <div class="tip-title">Food Safety</div>
                            <div class="tip-short">Keep your food safe during disasters.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Fire Safety" data-image="/images/tips/fire.jpg">
                        <img src="/images/tips/fire.jpg" class="tip-image" alt="Fire Safety">
                        <div class="tip-content">
                            <div class="tip-title">Fire Safety</div>
                            <div class="tip-short">Know how to prevent and act during fires.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Earthquake Safety" data-image="/images/tips/earthquake.jpg">
                        <img src="/images/tips/earthquake.jpg" class="tip-image" alt="Earthquake Safety">
                        <div class="tip-content">
                            <div class="tip-title">Earthquake Safety</div>
                            <div class="tip-short">Stay safe when the ground shakes.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Landslide Safety" data-image="/images/tips/landslide.jpg">
                        <img src="/images/tips/landslide.jpg" class="tip-image" alt="Landslide Safety">
                        <div class="tip-content">
                            <div class="tip-title">Landslide Safety</div>
                            <div class="tip-short">Stay alert in hilly areas.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Storm Safety" data-image="/images/tips/storm.jpg">
                        <img src="/images/tips/storm.jpg" class="tip-image" alt="Storm Safety">
                        <div class="tip-content">
                            <div class="tip-title">Storm Safety</div>
                            <div class="tip-short">Prepare before and during storms.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="tip-card" data-title="Flood Safety" data-image="/images/tips/flood.jpg">
                        <img src="/images/tips/flood.jpg" class="tip-image" alt="Flood Safety">
                        <div class="tip-content">
                            <div class="tip-title">Flood Safety</div>
                            <div class="tip-short">Prepare before and during flood.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Food Safety Detail Page -->
        <div id="food-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Food Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/food.jpg" class="detail-image" alt="Food Safety">

                <div class="section-heading">Before a Disaster (Preparation):</div>
                <ul>
                    <li>Keep appliance thermometers in your refrigerator and freezer</li>
                    <li>Freeze containers of water and gel packs to help keep food cold</li>
                    <li>Group food together in the freezer to help it stay cold longer</li>
                    <li>Stock up on non-perishable emergency food and supplies</li>
                    <li>Have a manual can opener and bottled water ready</li>
                </ul>

                <div class="section-heading">During a Power Outage:</div>
                <ul>
                    <li>Keep refrigerator and freezer doors closed as much as possible</li>
                    <li>A refrigerator will keep food cold for about 4 hours if unopened</li>
                    <li>A full freezer will hold temperature for about 48 hours (24 hours if half-full)</li>
                    <li>Use coolers with ice for perishable items if outage is prolonged</li>
                </ul>

                <div class="section-heading">After a Disaster:</div>
                <ul>
                    <li><strong>If power was out:</strong> Check temperatures. Discard perishable food that
                        has been above 40°F for more than 2 hours</li>
                    <li><strong>If floodwaters affected food:</strong> Discard any food that may have come
                        into contact with flood water</li>
                    <li>Sanitize surfaces and utensils with bleach solution (1 tbsp unscented bleach per
                        gallon of water)</li>
                    <li>Assume tap water is unsafe until authorities confirm it's safe</li>
                </ul>

                <div class="warning">When in doubt, throw it out! Do not taste food to determine if it's
                    safe.</div>
            </div>
        </div>

        <!-- Fire Safety Detail Page -->
        <div id="fire-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Fire Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/fire.jpg" class="detail-image" alt="Fire Safety">

                <div class="section-heading">Prevention:</div>
                <ul>
                    <li>Install smoke detectors on every level of your home and test monthly</li>
                    <li>Keep fire extinguishers accessible and know how to use them</li>
                    <li>Never leave cooking unattended - it's the leading cause of home fires</li>
                    <li>Keep flammable materials at least 3 feet from heat sources</li>
                    <li>Have your heating system inspected annually</li>
                </ul>

                <div class="section-heading">During a Fire:</div>
                <ul>
                    <li>Get out immediately and call for help once safely outside</li>
                    <li>If closed doors or handles are warm, use your second way out</li>
                    <li>Crawl low under smoke to your exit - cleaner air is near the floor</li>
                    <li>Stop, drop, and roll if your clothes catch fire</li>
                    <li>Once outside, go to your designated meeting place</li>
                </ul>

                <div class="section-heading">Escape Planning:</div>
                <ul>
                    <li>Create and practice a home fire escape plan with two ways out</li>
                    <li>Ensure windows and security bars can be opened from inside</li>
                    <li>Teach children how to escape on their own in case you can't help them</li>
                    <li>Designate a meeting spot a safe distance from your home</li>
                </ul>

                <div class="warning">Never re-enter a burning building for any reason.</div>
            </div>
        </div>

        <!-- Earthquake Safety Detail Page -->
        <div id="earthquake-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Earthquake Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/earthquake.jpg" class="detail-image" alt="Earthquake Safety">

                <div class="section-heading">Before an Earthquake:</div>
                <ul>
                    <li>Secure heavy furniture, appliances, and objects to walls</li>
                    <li>Practice "Drop, Cover, and Hold On" with all household members</li>
                    <li>Store breakable items in low, closed cabinets with latches</li>
                    <li>Overhead lighting fixtures should be securely braced</li>
                    <li>Know where your utility shut-offs are located and how to operate them</li>
                </ul>

                <div class="section-heading">During an Earthquake:</div>
                <ul>
                    <li>Drop down onto your hands and knees</li>
                    <li>Cover your head and neck with your arms</li>
                    <li>Hold on to any sturdy covering until shaking stops</li>
                    <li>If in bed, stay there and cover your head with a pillow</li>
                    <li>Stay away from glass, windows, and exterior doors</li>
                </ul>

                <div class="section-heading">After an Earthquake:</div>
                <ul>
                    <li>Expect aftershocks - each time drop, cover, and hold on</li>
                    <li>Check yourself for injuries and help others if trained</li>
                    <li>If in a damaged building, go outside and move away from buildings</li>
                    <li>Use text messages to communicate - phone lines may be overloaded</li>
                    <li>Listen to official news for emergency information</li>
                </ul>

                <div class="warning">Do not use elevators during or after an earthquake.</div>
            </div>
        </div>

        <!-- Landslide Safety Detail Page -->
        <div id="landslide-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Landslide Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/landslide.jpg" class="detail-image" alt="Landslide Safety">

                <div class="section-heading">Before a Landslide:</div>
                <ul>
                    <li>Learn about your area's landslide risk and history</li>
                    <li>Consult a professional for advice on appropriate protective measures</li>
                    <li>Flexible pipe fittings can be installed to avoid gas or water leaks</li>
                    <li>Plant ground cover on slopes and build retaining walls</li>
                    <li>Recognize landslide warning signs like new cracks or bulges</li>
                </ul>

                <div class="section-heading">During a Landslide:</div>
                <ul>
                    <li>Stay alert and awake - many deaths occur from slides at night</li>
                    <li>If in areas susceptible to landslides, consider evacuating</li>
                    <li>Listen for unusual sounds that might indicate moving debris</li>
                    <li>Move quickly away from the path of the slide</li>
                    <li>If escape is not possible, curl into a tight ball and protect your head</li>
                </ul>

                <div class="section-heading">After a Landslide:</div>
                <ul>
                    <li>Stay away from the slide area - there may be additional slides</li>
                    <li>Check for injured and trapped persons near the slide</li>
                    <li>Listen to local radio or television stations for emergency information</li>
                    <li>Watch for flooding which may occur after a landslide</li>
                    <li>Report broken utility lines to appropriate authorities</li>
                </ul>

                <div class="warning">Be especially alert when driving - watch for collapsed pavement, mud,
                    and fallen rocks.</div>
            </div>
        </div>

        <!-- Storm Safety Detail Page -->
        <div id="storm-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Storm Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/storm.jpg" class="detail-image" alt="Storm Safety">

                <div class="section-heading">Before a Storm:</div>
                <ul>
                    <li>Trim trees and remove damaged branches near your home</li>
                    <li>Secure outdoor objects that could blow away</li>
                    <li>Build an emergency kit with water, food, and supplies</li>
                    <li>Learn your community's warning system and evacuation routes</li>
                    <li>Install surge protectors to safeguard electronic equipment</li>
                </ul>

                <div class="section-heading">During a Storm:</div>
                <ul>
                    <li>Stay indoors away from windows, skylights, and glass doors</li>
                    <li>Avoid using corded electrical devices and plumbing</li>
                    <li>If driving, try to safely exit the road and park away from trees</li>
                    <li>Stay in the interior room or hallway on the lowest floor</li>
                    <li>Listen to battery-powered devices for weather updates</li>
                </ul>

                <div class="section-heading">After a Storm:</div>
                <ul>
                    <li>Continue listening to weather reports for updated information</li>
                    <li>Watch out for downed power lines and report them immediately</li>
                    <li>Check your home for damage carefully before entering</li>
                    <li>Take photographs of any damage for insurance purposes</li>
                    <li>Avoid walking or driving through floodwaters</li>
                </ul>

                <div class="warning">If you hear thunder, you are close enough to be struck by lightning.
                    Seek shelter immediately.</div>
            </div>
        </div>

        <!-- Flood Safety Detail Page -->
        <div id="flood-safety-page" class="detail-page">
            <div class="detail-header text-center">
                <div class="back-button" onclick="goBack()">
                    <span class="me-2">←</span> Back
                </div>
                <h2>Flood Safety</h2>
            </div>

            <div class="detail-content">
                <img src="/images/tips/flood.jpg" class="detail-image" alt="Flood Safety">

                <div class="section-heading">Before a Flood:</div>
                <ul>
                    <li>Know your area's flood risk and elevation above flood stage</li>
                    <li>Install check valves in sewer traps to prevent floodwater backup</li>
                    <li>Waterproof your basement and seal walls</li>
                    <li>Keep important documents in a waterproof container</li>
                    <li>Create a household emergency plan and evacuation route</li>
                </ul>

                <div class="section-heading">During a Flood:</div>
                <ul>
                    <li>Move to higher ground immediately if instructed to evacuate</li>
                    <li>Avoid walking through moving water - 6 inches can knock you down</li>
                    <li>Do not drive into flooded areas - turn around, don't drown</li>
                    <li>If your vehicle stalls in water, abandon it and seek higher ground</li>
                    <li>Stay away from downed power lines to prevent electrocution</li>
                </ul>

                <div class="section-heading">After a Flood:</div>
                <ul>
                    <li>Return home only when authorities say it is safe</li>
                    <li>Avoid floodwaters - they may be contaminated or electrically charged</li>
                    <li>Inspect your home for damage carefully before entering</li>
                    <li>Service damaged septic tanks and sewage systems immediately</li>
                    <li>Remove and replace drywall and insulation that has been contaminated</li>
                </ul>

                <div class="warning">Just 6 inches of moving water can knock you down, and 2 feet can sweep
                    your vehicle away.</div>
            </div>
        </div>
    </div>

    <script>
        // Function to show the detail page based on the card title
        function showDetailPage(title) {
            // Hide the dashboard
            document.getElementById('dashboard-page').style.display = 'none';

            // Show the appropriate detail page based on title
            const pageId = title.toLowerCase().replace(/\s+/g, '-') + '-page';
            document.getElementById(pageId).style.display = 'block';

            // Update the browser history
            window.history.pushState({
                page: pageId
            }, title, `#${pageId}`);
        }

        // Function to go back to the dashboard
        function goBack() {
            // Hide all detail pages
            const detailPages = document.querySelectorAll('.detail-page');
            detailPages.forEach(page => {
                page.style.display = 'none';
            });

            // Show the dashboard
            document.getElementById('dashboard-page').style.display = 'block';

            // Update browser history
            window.history.pushState({
                page: 'dashboard'
            }, 'Safety Tips', window.location.pathname);
        }

        // Add click event listeners to all cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.tip-card');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    const title = this.getAttribute('data-title');
                    showDetailPage(title);
                });
            });

            // Check if there's a hash in the URL to show the correct page
            if (window.location.hash) {
                const pageId = window.location.hash.substring(1);
                if (document.getElementById(pageId)) {
                    document.getElementById('dashboard-page').style.display = 'none';
                    document.getElementById(pageId).style.display = 'block';
                }
            }

            // Handle browser back/forward buttons
            window.addEventListener('popstate', function(event) {
                if (event.state && event.state.page) {
                    if (event.state.page === 'dashboard') {
                        goBack();
                    } else {
                        document.getElementById('dashboard-page').style.display = 'none';
                        const detailPages = document.querySelectorAll('.detail-page');
                        detailPages.forEach(page => {
                            page.style.display = 'none';
                        });
                        document.getElementById(event.state.page).style.display = 'block';
                    }
                }
            });
        });
    </script>
</body>

</html>
