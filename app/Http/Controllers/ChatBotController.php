<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot'); // your blade file
    }

    public function send(Request $request)
    {
        $message = strtolower($request->message);

        // Enhanced disaster keywords dictionary
        $responses = [
            'flood' => [
                'keywords' => ['flood', 'flooding', 'flooded', 'water level', 'rising water', 'flash flood'],
                'reply' => "⚠️ Flood Safety Tips:\n• Move to higher ground immediately\n• Avoid walking or driving through flood waters\n• Just 6 inches of moving water can knock you down\n• 2 feet of water can sweep your vehicle away\n• Listen to official alerts and evacuation orders\n• Stay away from downed power lines\n• Return home only when authorities say it's safe"
            ],
            'fire' => [
                'keywords' => ['fire', 'wildfire', 'burning', 'smoke', 'blaze', 'forest fire'],
                'reply' => "🔥 Fire Safety Tips:\n• Get out immediately and call for help\n• Stay low to avoid smoke inhalation\n• Use the stairs, not elevators\n• Check doors for heat before opening\n• Stop, drop, and roll if clothes catch fire\n• Have a family meeting place outside\n• Never re-enter a burning building"
            ],
            'storm' => [
                'keywords' => ['storm', 'cyclone', 'hurricane', 'typhoon', 'thunderstorm', 'lightning'],
                'reply' => "🌪 Storm Safety Tips:\n• Stay indoors away from windows\n• Secure outdoor objects that could blow away\n• Avoid using corded electrical devices\n• Unplug electronic equipment\n• Listen to battery-powered radio for updates\n• If driving, try to safely exit the road\n• Avoid flooded roadways"
            ],
            'earthquake' => [
                'keywords' => ['earthquake', 'quake', 'tremor', 'shaking', 'aftershock', 'seismic'],
                'reply' => "🌍 Earthquake Safety Tips:\n• Drop, Cover, and Hold On\n• Stay indoors until shaking stops\n• If in bed, stay there and protect your head\n• Stay away from glass, windows, and exterior doors\n• Do not use elevators\n• Expect aftershocks\n• Check for injuries and damage after shaking stops"
            ],
            'landslide' => [
                'keywords' => ['landslide', 'mudslide', 'rockfall', 'slope', 'erosion', 'debris flow'],
                'reply' => "⛰ Landslide Safety Tips:\n• Move away from landslide path quickly\n• Listen for unusual sounds indicating moving debris\n• Be especially alert when driving\n• Watch for collapsed pavement, mud, and fallen rocks\n• Recognize warning signs like new cracks or bulges\n• Consult professionals for protective measures\n• Stay away from slide area after the event"
            ],
            'tsunami' => [
                'keywords' => ['tsunami', 'tidal wave', 'coastal flood', 'ocean wave'],
                'reply' => "🌊 Tsunami Safety Tips:\n• Move to higher ground immediately if near coast\n• Follow evacuation routes marked by authorities\n• Never go to the beach to watch a tsunami\n• If you can see the wave, you are too close\n• Stay away from the coast until officials say it's safe\n• Be alert for signs of a tsunami after strong earthquake"
            ],
            'tornado' => [
                'keywords' => ['tornado', 'twister', 'funnel cloud', 'cyclone'],
                'reply' => "🌪 Tornado Safety Tips:\n• Go to a basement, storm cellar, or interior room\n• Stay away from windows, doors, and outside walls\n• Get under something sturdy like a heavy table\n• Protect your head and neck with your arms\n• If in a vehicle, do not try to outrun a tornado\n• Seek shelter in a sturdy building immediately\n• If outdoors with no shelter, lie flat in a ditch"
            ],
            'heatwave' => [
                'keywords' => ['heatwave', 'heat stroke', 'extreme heat', 'hot weather', 'dehydration'],
                'reply' => "☀️ Heatwave Safety Tips:\n• Stay hydrated with water, avoid alcohol and caffeine\n• Stay in air-conditioned places as much as possible\n• Never leave children or pets in vehicles\n• Wear lightweight, light-colored, loose-fitting clothing\n• Limit outdoor activities to morning and evening hours\n• Check on older adults, young children, and those with health conditions\n• Know the signs of heat exhaustion and heat stroke"
            ],
            'blizzard' => [
                'keywords' => ['blizzard', 'snowstorm', 'winter storm', 'heavy snow', 'ice storm'],
                'reply' => "❄️ Winter Storm Safety Tips:\n• Stay indoors during the storm\n• If you must go outside, wear layered clothing\n• Avoid overexertion when shoveling snow\n• Keep dry to prevent loss of body heat\n• Watch for signs of frostbite and hypothermia\n• Travel only if necessary and keep emergency kit in vehicle\n• Maintain ventilation when using alternative heat sources"
            ],
            'pandemic' => [
                'keywords' => ['pandemic', 'virus', 'outbreak', 'covid', 'coronavirus', 'contagious'],
                'reply' => "🦠 Pandemic Safety Tips:\n• Wash hands frequently with soap and water\n• Practice social distancing\n• Wear a mask in crowded places\n• Avoid touching your face with unwashed hands\n• Cover coughs and sneezes with elbow or tissue\n• Stay home if you feel sick\n• Follow official health guidelines and get vaccinated"
            ],
            'first aid' => [
                'keywords' => ['first aid', 'cpr', 'bleeding', 'choking', 'burn', 'injury'],
                'reply' => "🩹 First Aid Tips:\n• For bleeding: Apply direct pressure with clean cloth\n• For burns: Cool with running water for 10-20 minutes\n• For choking: Perform abdominal thrusts (Heimlich maneuver)\n• For CPR: Push hard and fast in center of chest (100-120 compressions/min)\n• Always call for professional medical help for serious injuries\n• Keep a well-stocked first aid kit available"
            ],
            'evacuation' => [
                'keywords' => ['evacuate', 'evacuation', 'shelter', 'relief center', 'emergency shelter'],
                'reply' => "🚨 Evacuation Tips:\n• Follow official evacuation orders immediately\n• Have a go-bag ready with essentials\n• Know your evacuation routes and alternatives\n• Inform family members of your plans\n• Take pets with you in evacuations\n• Turn off utilities if instructed to do so\n• Lock your home when leaving"
            ],
            'greeting' => [
                'keywords' => ['hello', 'hi', 'hey', 'greetings', 'howdy'],
                'reply' => "Hello! I'm your disaster safety assistant. How can I help you today? You can ask me about floods, fires, earthquakes, storms, or other emergency situations."
            ],
            'thanks' => [
                'keywords' => ['thank', 'thanks', 'appreciate', 'grateful'],
                'reply' => "You're welcome! Stay safe and remember to always follow official instructions from local authorities during emergencies."
            ]
        ];

        // Default fallback safety reply
        $reply = "ℹ️ General Disaster Safety Information:\n
- Call local emergency services immediately if you are in danger\n
- Keep an emergency kit with first aid supplies, flashlight, water, and non-perishable food\n
- Stay informed through official channels and weather alerts\n
- Develop and practice a family emergency plan\n
- Know your evacuation routes and shelter locations\n
- Secure your home against potential hazards\n
- Check on neighbors, especially the elderly and vulnerable\n\nWhat specific disaster situation would you like to know about?";

        // Check if user message matches any disaster keywords
        foreach ($responses as $disaster) {
            foreach ($disaster['keywords'] as $keyword) {
                if (str_contains($message, $keyword)) {
                    $reply = $disaster['reply'];
                    break 2; // stop loop once match found
                }
            }
        }

        return response()->json(['reply' => $reply]);
    }
}