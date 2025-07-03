<?php
function RootLayout($render)
{
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Chatapp</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
    @theme {
          --color-brand-primary: #c62828;     /* Bold red – main brand */
          --color-brand-secondary: #8e0000;   /* Deep red – for buttons, highlights */
          --color-bg-page: #fff5f5;           /* Light rosy background */
          --color-custom-red: #e74c3c;        /* Accent red (keep for alerts/errors) */
          --color-neutral-dark: #2c2c2c;      /* Dark gray for text */
          --color-neutral-light: #fcebea;     /* Very light red-pink for cards or panels */
          }
    </style>

  </head>

  <body class="bg-bg-page min-h-screen flex items-center justify-center p-4">

    <?php $render(); ?>

  </body>

  </html>
<?php } ?>