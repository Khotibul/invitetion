<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title ?? 'Wedding Invitation' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #d4af37;
            --secondary: #1a1a1a;
            --light: #f8f6f0;
            --white: #ffffff;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary);
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Great Vibes', cursive;
            color: var(--primary);
        }

        /* Cover Section */
        .cover {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--light) 0%, #fff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .cover::before {
            content: '';
            position: absolute;
