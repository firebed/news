<div class="col-auto" style="margin-top: -5px; width: 160px !important">
    <div x-data="{
            prayer: '',
            time: '',
            city: '',
            load() {
                axios.get('{{ route('prayer-times') }}')
                    .then(res => {
                        this.prayer = res.data.prayer
                        this.time = res.data.time
                        this.city = 'İskeçe'
                    })
            }
        }"
         x-init="load()"
         x-cloak
         x-show="prayer"
         x-transition
    >
        <div class="d-grid">
            <div class="lh-sm fs-5" x-text="time" style="font-weight: 500"></div>
            <div class="small lh-sm" x-text="prayer"></div>
            <div class="small lh-sm" x-text="city"></div>
        </div>
    </div>
</div>
