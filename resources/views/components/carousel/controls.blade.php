@props(['target'])

<button
    type="button"
    class="carousel-control-prev top-50 translate-middle-y rounded"
    style="left: 20px; width: 2.5rem; height: 2.5rem; background-color: rgba(0, 0, 0, .5)"
    data-bs-target="{{ $target }}"
    data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>

<button
    type="button"
    class="carousel-control-next top-50 translate-middle-y rounded"
    style="right: 20px; width: 2.5rem; height: 2.5rem; background-color: rgba(0, 0, 0, .5)"
    data-bs-target="{{ $target }}"
    data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
