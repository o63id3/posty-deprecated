<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto my-12 p-12 border bg-gray-100 h-full overflow-auto">
        <section class="mb-4 bg-gray-200">
          <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 1</div>
          <div class="p-4">
            stick content 1 stick content 1 stick content 1 stick content 1 stick content 1
            stick content 1 stick content 1 stick content 1 stick content 1 stick content 1
            stick content 1 stick content 1 stick content 1 stick content 1 stick content 1
          </div>
        </section>
        <section class="mb-4 bg-gray-200">
          <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 2</div>
          <div class="p-4">
            stick content 2 stick content 2 stick content 2 stick content 2 stick content 2
            stick content 2 stick content 2 stick content 2 stick content 2 stick content 2
            stick content 2 stick content 2 stick content 2 stick content 2 stick content 2
          </div>
        </section>
        <section class="mb-4 bg-gray-200">
          <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
          <div class="p-4">
            stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
          </div>
        </section>
        <section class="mb-4 bg-gray-200">
            <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
            <div class="p-4">
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            </div>
          </section>
          <section class="mb-4 bg-gray-200">
            <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
            <div class="p-4">
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            </div>
          </section>
          <section class="mb-4 bg-gray-200">
            <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
            <div class="p-4">
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            </div>
          </section>
          <section class="mb-4 bg-gray-200">
            <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
            <div class="p-4">
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            </div>
          </section>
          <section class="mb-4 bg-gray-200">
            <div class="p-2 bg-black text-white sticky top-0 uppercase">Sticky Heading 3</div>
            <div class="p-4">
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
              stick content 3 stick content 3 stick content 3 stick content 3 stick content 3
            </div>
          </section>
          
    </div>
</body>
</html>



@foreach ($post->likes as $like)
    <li>
        <button href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg w-full hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
            <div class="flex justify-between">
                <div class="flex items-center space-x-4">
                    <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full">
                        <svg class="absolute -left-1 w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        {{ $like->user->getName()     }}
                    </div>
                </div>
            </div>
        </button>
    </li>
@endforeach

<button id="likes-btn" class="hover:underline" data-modal-toggle="likes-modal">
    {{ $post->likes()->count() }} {{ Str::plural('Like', $post->likes()->count()) }}
</button>