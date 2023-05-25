<?php

namespace App\Http\Controllers;

class RandomController extends Controller
{
    public function quote()
    {
        $quotes = [
            [
                "quote" => "Success is not final, failure is not fatal=>It is the courage to continue that counts.",
                "author" => "Winston Churchill",
            ],
            [
                "quote" => "Success is not the key to happiness. Happiness is the key to success. If you love what you are doing, you will be successful.",
                "author" => "Albert Schweitzer",
            ],
            [
                "quote" => "Success is not in what you have, but who you are.",
                "author" => "Bo Bennett",
            ],
            [
                "quote" => "Success usually comes to those who are too busy to be looking for it.",
                "author" => "Henry David Thoreau",
            ],
            [
                "quote" => "The only place where success comes before work is in the dictionary.",
                "author" => "Vidal Sassoon",
            ],
            [
                "quote" => "Success is not the key to success. You have to dream before your dreams can come true.",
                "author" => "A. P. J. Abdul Kalam",
            ],
            [
                "quote" => "Success is not just about making money. It's about making a difference.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not for the lazy.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is walking from failure to failure with no loss of enthusiasm.",
                "author" => "Winston Churchill",
            ],
            [
                "quote" => "The secret to success is to know something nobody else knows.",
                "author" => "Aristotle Onassis",
            ],
            [
                "quote" => "The road to success is always under construction.",
                "author" => "Lily Tomlin",
            ],
            [
                "quote" => "Success is a journey, not a destination.",
                "author" => "Arthur Ashe",
            ],
            [
                "quote" => "The only limit to our realization of tomorrow will be our doubts of today.",
                "author" => "Franklin D. Roosevelt",
            ],
            [
                "quote" => "Success is not about the destination, but the journey to get there.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not just about making money. It's about making a difference.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not the result of spontaneous combustion. You must set yourself on fire.",
                "author" => "Arnold H. Glasow",
            ],
            [
                "quote" => "Success is not measured by what you accomplish, but by the opposition you have encountered, and the courage with which you have maintained the struggle against overwhelming odds.",
                "author" => "Orison Swett Marden",
            ],
            [
                "quote" => "Success is not in what you have, but who you are.",
                "author" => "Bo Bennett",
            ],
            [
                "quote" => "Success is the sum of small efforts, repeated day in and day out.",
                "author" => "Robert Collier",
            ],
            [
                "quote" => "Success is not the absence of failure; it's the persistence through failure.",
                "author" => "Aisha Tyler",
            ],
            [
                "quote" => "Success is not the key to happiness. Happiness is the key to success.",
                "author" => "Herman Cain",
            ],
            [
                "quote" => "Success is not about being the best. It's about always getting better.",
                "author" => "Behdad Sami",
            ],
            [
                "quote" => "The only place where success comes before work is in the dictionary.",
                "author" => "Vidal Sassoon",
            ],
            [
                "quote" => "Success usually comes to those who are too busy to be looking for it.",
                "author" => "Henry David Thoreau",
            ],
            [
                "quote" => "Success is not the key to success. You have to dream before your dreams can come true.",
                "author" => "A. P. J. Abdul Kalam",
            ],
            [
                "quote" => "Success is not just about making money. It's about making a difference.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not for the lazy.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is walking from failure to failure with no loss of enthusiasm.",
                "author" => "Winston Churchill",
            ],
            [
                "quote" => "The secret to success is to know something nobody else knows.",
                "author" => "Aristotle Onassis",
            ],
            [
                "quote" => "The road to success is always under construction.",
                "author" => "Lily Tomlin",
            ],
            [
                "quote" => "Success is a journey, not a destination.",
                "author" => "Arthur Ashe",
            ],
            [
                "quote" => "The only limit to our realization of tomorrow will be our doubts of today.",
                "author" => "Franklin D. Roosevelt",
            ],
            [
                "quote" => "Success is not about the destination, but the journey to get there.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not the result of spontaneous combustion. You must set yourself on fire.",
                "author" => "Arnold H. Glasow",
            ],
            [
                "quote" => "Success is not measured by what you accomplish, but by the opposition you have encountered, and the courage with which you have maintained the struggle against overwhelming odds.",
                "author" => "Orison Swett Marden",
            ],
            [
                "quote" => "Success is not in what you have, but who you are.",
                "author" => "Bo Bennett",
            ],
            [
                "quote" => "Success is the sum of small efforts, repeated day in and day out.",
                "author" => "Robert Collier",
            ],
            [
                "quote" => "Success is not the absence of failure; it's the persistence through failure.",
                "author" => "Aisha Tyler",
            ],
            [
                "quote" => "Success is not the key to happiness. Happiness is the key to success.",
                "author" => "Herman Cain",
            ],
            [
                "quote" => "Success is not about being the best. It's about always getting better.",
                "author" => "Behdad Sami",
            ],
            [
                "quote" => "Success is not the absence of problems; it's the ability to deal with them.",
                "author" => "Steve Maraboli",
            ],
            [
                "quote" => "Success is not just about making money. It's about making a difference.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not for the weak and uncommitted. Sometimes it's gonna hurt.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not the key to happiness. Happiness is the key to success.",
                "author" => "Herman Cain",
            ],
            [
                "quote" => "Success is not about being the best. It's about always getting better.",
                "author" => "Behdad Sami",
            ],
            [
                "quote" => "The only place where success comes before work is in the dictionary.",
                "author" => "Vidal Sassoon",
            ],
            [
                "quote" => "Success usually comes to those who are too busy to be looking for it.",
                "author" => "Henry David Thoreau",
            ],
            [
                "quote" => "Success is not the key to success. You have to dream before your dreams can come true.",
                "author" => "A. P. J. Abdul Kalam",
            ],
            [
                "quote" => "Success is not just about making money. It's about making a difference.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not for the lazy.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is walking from failure to failure with no loss of enthusiasm.",
                "author" => "Winston Churchill",
            ],
            [
                "quote" => "The secret to success is to know something nobody else knows.",
                "author" => "Aristotle Onassis",
            ],
            [
                "quote" => "The road to success is always under construction.",
                "author" => "Lily Tomlin",
            ],
            [
                "quote" => "Success is a journey, not a destination.",
                "author" => "Arthur Ashe",
            ],
            [
                "quote" => "The only limit to our realization of tomorrow will be our doubts of today.",
                "author" => "Franklin D. Roosevelt",
            ],
            [
                "quote" => "Success is not about the destination, but the journey to get there.",
                "author" => "Unknown",
            ],
            [
                "quote" => "Success is not the result of spontaneous combustion. You must set yourself on fire.",
                "author" => "Arnold H. Glasow",
            ],
            [
                "quote" => "Success is not measured by what you accomplish, but by the opposition you have encountered, and the courage with which you have maintained the struggle against overwhelming odds.",
                "author" => "Orison Swett Marden",
            ],
            [
                "quote" => "Success is not in what you have, but who you are.",
                "author" => "Bo Bennett",
            ],
            [
                "quote" => "Success is the sum of small efforts, repeated day in and day out.",
                "author" => "Robert Collier",
            ],
            [
                "quote" => "Success is not the absence of failure; it's the persistence through failure.",
                "author" => "Aisha Tyler",
            ],
        ];

        $randomIndex = rand(0, count($quotes) - 1);

        return response()->json([
            'quote' => $quotes[$randomIndex]['quote'],
            'author' => $quotes[$randomIndex]['author'],
        ]);
    }

    public function image()
    {
        $randomIndex = rand(0, 30);
        $url = 'https://api.ledinhcuong.com/storage/images/default/posts/' . $randomIndex . '.jpg';
        return response()->json([
            'url' => $url,
        ]);
    }
}