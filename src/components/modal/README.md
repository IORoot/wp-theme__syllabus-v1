# CSSUI Modal + TAILWIND version

[[toc]]

## HTML

```html
<link rel="stylesheet" href="modal.css">

<a href="#modal">
  Open Modal
</a>

<!-- Modal container -->
<div id="modal" data-modal>
  <!-- Modal  -->
  <div id="dialog" data-modal-dialog role="dialog" aria-modal="true" aria-labelledby="dialog-title" tabindex="-1">
    <h3 id="dialog-title">Modal title</h3>
    <p>This is the modal content.</p>

    <a href="#" aria-label="Close modal" data-modal-close>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </a>
  </div>
  <!-- Background, click to close -->
  <a href="#" tabindex="-1" data-modal-overlay></a>
</div>
```


## CSS

```css
/* Modal properties */

[data-modal] {
  --modal-background: rgb(255, 255, 255);
  --modal-level: 9999;
  --modal-max-size: 500px;
  --modal-overlay-background: rgba(0, 0, 0, .2);
  --modal-radius: 8px;
  --modal-size: 80%;
  --modal-spacing: 1rem;

  visibility: hidden;
  opacity: 0;
  transition: opacity .3s ease;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

[data-modal-overlay] {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: var(--modal-overlay-background);
}

[data-modal-dialog] {
  z-index: var(--modal-level);
  width: var(--modal-size);
  max-width: var(--modal-max-size);
  padding: var(--modal-spacing);
  border-radius: var(--modal-radius);
  background-color: var(--modal-background);
  opacity: 0;
  transform: translateY(-1rem);
  transition: opacity .3s ease, transform .3s ease;
  transition-delay: .2s;
}

[data-modal]:target {
  visibility: visible;
  opacity: 1;
  z-index: var(--modal-level);
}

[data-modal]:target [data-modal-dialog] {
  opacity: 1;
  transform: translateY(0);
}

[data-modal-close] {
  position: absolute;
  top: var(--modal-spacing);
  right: var(--modal-spacing);
  color: var(--cssui-gray-darkest);
}

```


### TAILWIND VERSION

```html
<!-- MODAL CONTENTS -->	
	<div data-modal id="modal{{loop_index}}" class="group z-50 fixed inset-0 items-center justify-center target:flex opacity-0 target:opacity-100 invisible target:visible transition-opacity" >
      <div data-modal-dialog tabindex="-1" class="z-50 w-4/5 max-w-screen-sm p-4 rounded-xl bg-zinc-100 opacity-0 group-target:opacity-100">
          <h3 class="text-xl mb-4">{{post_title}}</h3>
          <p>{{post_content}}</p>
          <a href="#" class="absolute top-1 right-1"> <svg class="w-6 h-6"><use xlink:href="#close"</use></svg>  </a>
      </div>
      <a href="#" tabindex="-1" class="fixed inset-0 bg-zinc-900 opacity-70"></a>
	</div>
```

```css (optional animation)
<style>

	[data-modal] {
	  transition: opacity .3s ease;
	}

	[data-modal-dialog] {
	  transform: translateY(-1rem);
	  transition: opacity .3s ease, transform .3s ease;
	  transition-delay: .2s;
	}

	[data-modal]:target [data-modal-dialog] {
	  transform: translateY(0);
	}
</style>
```