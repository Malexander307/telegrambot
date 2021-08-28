<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebHookController extends Controller
{
    public function index(Request $request)
    {
        $path = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10";
        $request = $request->toArray();
        if (!isset($request["callback_query"])) {
            $chatId = (int)trim($request["message"]["chat"]["id"]);
            $name = $request["message"]["from"]["first_name"];
            Http::post($path . "/sendmessage?chat_id=" . $chatId . "&text=" . (string)json_encode($request));
            $text = "Hello " . $name;
            $keyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'test', 'callback_data' => 'test'],
                        ['text' => 'Watch', 'callback_data' => 'watch_mems']
                    ],
                ]
            ];
            $encodedKeyboard = json_encode($keyboard);
            $parameters =
                array(
                    'chat_id' => $chatId,
                    'text' => $text,
                    'reply_markup' => $encodedKeyboard
                );
            switch ($request["message"]["text"]) {
                case 'f':
                    $this->send('sendMessage', $parameters);
                    break;
            }
        }
        if (isset($request["callback_query"])) {
            switch ($request["callback_query"]['data']) {
                case 'test':
                    $chatId = $request['callback_query']['from']['id'];
                    Http::post($path . "/sendPhoto?chat_id=" . $chatId . "&photo=" . "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEBUQEhATFRMRFRYPExUXEhYYFhUVFxIXFhUTFhcYKCkiGBolGxgVITEhJykrLi4vFx8zOzMsNygtLisBCgoKDg0NFQ8QFSsdFR0tKy0rKystKy0rNystLSsrKy0rLSstNysrLSsrKysrKystKy0rLSsrKysrKysrKysrK//AABEIALcBEwMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAAAwIEBQYHCAH/xABDEAACAgEBBAcFBAcFCQEAAAAAAQIDEQQFEiExBgcTQVFhcSIygZGxFELB0SMzUmJygqEVJEOS4Rdkg5OitMLw8Rb/xAAWAQEBAQAAAAAAAAAAAAAAAAAAAQL/xAAZEQEBAQEBAQAAAAAAAAAAAAAAARECEjH/2gAMAwEAAhEDEQA/AO4gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEc7UuHf4LmBICCNrzxSS8O/5kqmgKgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADA9I+l2k0S/TWrfxlVR9qx+Hsr3V5vCAzwOK7X63tTOX93qqqh3b6dk35vDUV6YfqWen639dD346exedcov4OMsf0LjPqO7A5JszrwpbUdTpLK/GdU1Yl5uL3X8snRNh9JdNrK+00t0bV3pcJR8pxlhx+KIssrLkc7UuHN+C/94EcpN8/kvzPiQV9cm/LyXP5lrpNdTOUoVW1TlW8WRhZGUov99J5T9TVesXopq9dXu6XaE6Fu4dDW7VY+PvTh7az4PeXDkjhX/wCE2vptVGuvS6iNuf0dtLe7/Ero+zFerXmB6oBrfQbSbRroxtLUVWz4bqjD24+U7FhTf8v8zNkA+qTJI2eJEALhM+lsVqxgTAo7Vd/AqTA+gAAAAAAAAAAAAAAAAAAAWW2tqV6XT2am6W7XTFzk8Zfgkl3tvCS8WBemv9JOmOk0SxdbmzGVVD2rH4ZX3V5yaRyPpJ1sajU5hRL7NU+HB/ppL96f3fSPLxZpVlnNt5zxbzlt97b72XGL03vpL1n6rUZhR/dqnw9l5ta85/d/lw/M0O23i23lt5bby2+9t97LO/V9yLOVjfNlxi3V5drPAtJ2NlAKBVVY4yU4ycZx4xlFuMl5qS4opAG89H+tXaGmxGc1qa1w3bs7+PK1e1nzlvG1/wC1OOoa3b56WbcYxhNQ7Jct6UruPDn7276HGz6F9V680VqlXGSnCeYr24NOEnjjKLXDGSY8nbD29qdHLf0uosqzxai/Yl/FW8xl8UdP6NddS4Q19GO7tqVw/mqbyvWLfoZsbnUdiMB0z6Uw2fp3qJ03W80o1wbSfjOfu1rzfwTLPYnTJam2uNVUJ1W5anC3fcUu+aS9l+Me7zNrf14MmNa8+VdeutV7nLT0Ol8qVvKSXlbzz5tY8jqvQrrE0m0n2dXaQvUXOVU4PgljLU45i1x72n5Fp0k6qdm6uXadlLTzzmUqHGCkuOd6DTj380k/MyOxoaXSQ+y7N0ym17+4/Z3se9dc/efz+AG0N44vkuL/ADMTZtrfbhpa+2kuDnndpi/3rPvekclMdjzt9rV29p3qmGY0r1XOz4/Iy9cFFKMUklwSSwkvBJAYuvY7m97VWdq+arS3aY+kPv8ArLPoZunl6cCIlp5fF/VgVgAAAAAAAAAAAAAAAAAAaJ125/sW/H7dH/cVm9mn9blW9sbUrwVcv8t9b/ADzFvNfdf1+hVCxPv/AAfyJmimdafNBFLj5lD4H3da5P4P8+ZVG5cpLH0+f5l1m8xQCfsU+X+hHKtru+RdZvNUAFMpYKio+ORC7PAKOSasiuVhSlkrUSomrIv+j229RorlfprXXPlJc42L9myL4SX9V3NM7p0P6zYa2Kq+zy+2Y/VRktyaXOyE5corvT4rPeuJwSnSSlx5Lxf4LvNp6vtOobV0e63vO1refnXNNY8OJnW471/ZNl3HV25jz7CpuNf88ven9DLUUxhFQhFRiuUYpJL4IkBVACG3UJcOb8F+IExLS+Hz+pYKEp8+XguX+pf1QxFLwArAAAAAAAAAAAAAAAAAAA1rrJhnZGt8tPZL/LHe/A2Uw3TOnf2dq4ftaa+PzqkB5z6AyX9p6WMownCy1UzjOEZxlCxOEk4yyuTN36X9CtJY9f8AYqnTqNnOu2VUZuVd1U6VZvRg/wBXL9Yko8PYX7XDn3QrUVw2hpbbro1V13QulOUZNJQkpY9nlnGM8lnPcd02Hs1Paut2r2sZaS7T1V1yjOMq7UoRdk21nhHcx/PII4Botl3XRnOmiy2NSi7HCDluKWd1tR444P5Fk4nXeqrT6GOupt0WstlK2m2N2mnW47nCMt5SWE4J4S5vjz5owPZV63pDfDXKbqjdqK5KqueXGqUoVb3YreSwotz8uL4gc9UMcnj05fLkSw1H7S+K/L/6ZLpTo6tPrb6Kpyddc8VuacZuLipLKkk+/CeOOE+8xjiBN2cJrg0/TmjHavSSjx5x8fD1Lhw708PxXMuadV3T4d2e5+vgBjaoEpeXaPit1pZeGnyXmiWvTwi8NqT8Xwj8F+Y0xaU6aUvJeL5fDxLyFUK+L4tccv8ABdxHfqGuPhh/iinVe7nxTf1IvxLqNR4Phxw+WV4mZ6D3Y1+hk3xeprWf4pRj+Jr9kvZXmuRf9G2/tOjfdHU0cM82rq22/h5gerCO21R5v4d5FK9y4RWPPvK6NJ3soj3pT4Lgv6/MuKdIkXEIJFQHxLB9AAAAAAAAAAAAAAAAAAAAAQ6uhWVzrecWRlW8c8STTx8yYAeVemfQ+/Ztu5Yt+mTxTcl7M13Rl+zYlzj5ZWUYTT62yEZwhbZCFqxZGFkoxsXhOKeJLyZ602vsuu+uVVlcZ1zWJQkspr0/E4d0y6qLaXK3Q71tfFumT/Sw8oN/rF5P2v4gML1ZdIdNodb9o1Ku9x1wlXhqO977nF8ZLhHG7xWHwZvXR3ZVL2jDadGohc9RtO3HY2Se5p7dJfZu3V4ThLfSypLhhHFZxcW4yTjKLxKLTTT8GnxTJtFrLKrFbVZOuyPuzhJxkvLK7vII9HaSmuer2xC6CnCEqrMbsd5b+z4Ke7J8U2oI0Xb/AES2fXHZWsoos7DX3UU2Uzus4w1FWYS3suUZR54Tw2vniOjPWnbVK37XRG9amMa7bq1GF7UYOEZNcIWNJ4+6/N4Rsn9pU6zZ2yaNLYrLdFq9D2tTxG6MKl2cp9m+MkuDbjlJZeeDCtS61+jdGh1sKdNCUa3p43yTnOeH2tkJSzJtpYUPL5mlYPVu17K6/tF9dMbtVXpU+zz7U607ZVw48k5qzlzx6HlnX653WzucK4Ox77jVBQrXD7sFy8fVt94RauTWEnw8PD0/IqnP6pfNootfL1/8WLOXy/oBca18PWK+h91LbivDHxefwPmqj9F9BqZezFfuogOPsR9Po2ZLo4v7xpF/vVTf/OrMfNexD0f1M50K0MrddpK4LLjbC2WOUYxsU5N+SS+bwQeooVJFYBpQAAAAAAAAAAAAAAAAAAAAAAAAAACK2hSJQBqXSboVpdYv09EZSxhWR9myPhiceOPJ5Xkcp6SdUN9WZ6Sztor/AA54hb8JcIT/AOn4noMisoTA8eazS2UzdV1c67I84Ti4yXnh93nyIoyw002mnlNPDT8U1yZ6v230co1MOzvphbHuUo5x5xfOL81g5T0m6nGsz0N2O/sbnw9I2rivSSf8QGsdHusnW6e6qyyx6iNSlW42Nb8q5YzB3YcnhpSWc8V5mH6V6nS26h36RWQje5W2Uzgl2NkpZlGEotqUW8tcsZx6WO2Nj6jSz3NTTOqT5by9mX8Ml7MvgyxyEVWd3r+DKprgRSf1X1LhLKAm1bz8l9CuyvecIpNywlhLLbfJY8eRs3RnoJqta1Pd7Gl4xbNPiv3Ic5+vBeZ2Top0G02jSdcN6zvtnhzfjjugvJY88kVzboz1ZX37s9VmipJYh/iyXPinwh8ePkjrvR3o1RpYblFUYLg5PnKTXfOT4yfqZqnTpE5QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAonUn3FYAxmv2TCyLhOEZwlzjOKlF+sXwZpO2eqnQW5caZUSf3qZOKX/DeYf0R0k+NAcGt6lZ9p7Otj2fNZoe/8cSw/X+huPRnqx0mnanKLvsXFStScU1xzGtcM573lo6L2K8CuMUgLanSJcy5SwfQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf/2Q==");
                    Http::post($path . "/answerCallbackQuery?callback_query_id=". $request['callback_query']['id']);
                    break;
            }
        }
    }

    private function send($method, $data)
    {
        $url = "https://api.telegram.org/bot1955140014:AAE0KkWUJzKP6fnCmX2UsJ0iQocFz8FYG10" . "/" . $method;

        if (!$curld = curl_init()) {
            exit;
        }
        curl_setopt($curld, CURLOPT_POST, true);
        curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curld, CURLOPT_URL, $url);
        curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curld);
        curl_close($curld);
        return $output;
    }
}


