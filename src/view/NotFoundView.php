<?= $this->layout('LayoutView', ['title' => 'Página não encontrada', 'noHeader' => true]) ?>
<main class=" rounded-md h-screen w-full flex flex-col justify-center items-center bg-gradient-to-br from-indigo-500 to-indigo-800">
	<h1 class="text-9xl font-extrabold text-white tracking-widest">404</h1>
	<h1 class="text-9xl font-extrabold text-white tracking-widest">404</h1>
	<div class="bg-indigo-800 p-2 text-sm rounded rotate-12 absolute text-white">
		Oops, está página não existe 😥
	</div>
	<button class="mt-5">
      <a
        class="relative inline-block text-sm font-medium text-white group active:text-orange-500 focus:outline-none focus:ring"
      >
        <span
          class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-gradient-to-br from-indigo-500 to-indigo-800 group-hover:translate-y-0 group-hover:translate-x-0"
        ></span>
        <a href="<?= parseUrlRoute('/') ?>" class="border-2 border-white bg-transparent hover:border-0 hover:bg-indigo-800 text-white py-3 px-4 rounded-md"><i class="fas fa-arrow-left"></i> Inicio</a>
      </a>
    </button>
</main>