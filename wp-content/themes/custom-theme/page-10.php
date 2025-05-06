<?php get_header(); ?>

<div id="" class="py-36 max-w-6xl mx-auto px-8">
    <h1 class="font-bold text-5xl mb-8">Contact Us</h1>
    <form action="#" class="space-y-8">
        <div>
            <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
            <input type="email" id="email" class="block p-3 w-full text-sm  rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500  " placeholder="" required>
        </div>
        <div>
            <label for="subject" class="block mb-2 text-sm font-medium">Subject</label>
            <input type="text" id="subject" class="block p-3 w-full text-sm  rounded-lg border  shadow-sm focus:ring-primary-500 focus:border-primary-500   " placeholder="Let us know how we can help you" required>
        </div>
        <div class="sm:col-span-2">
            <label for="message" class="block mb-2 text-sm font-medium ">Your message</label>
            <textarea id="message" rows="6" class="block p-2.5 w-full text-sm  rounded-lg shadow-sm border  focus:ring-primary-500 focus:border-primary-500   " placeholder="Leave a comment..."></textarea>
        </div>
        <button type="submit" class="bg-red-400 hover:bg-fuchsia-400 text-white font-bold py-2 px-4 rounded-full">Send message</button>
    </form>
</div>

<?php get_footer(); ?>