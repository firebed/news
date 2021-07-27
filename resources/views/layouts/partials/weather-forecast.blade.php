<div class="col-auto" style="width: 220px !important; height: 70px !important">
    <div class="h-100" x-data="{
            icon: '',
            temp: '',
            summary: '',
            city: '',
            load() {
                axios.get('{{ route('weather-forecast') }}').then(res => {
                    this.icon = res.data.icon
                    this.temp = res.data.temp.replace('&deg;', '°')
                    this.summary = res.data.summary
                    this.city = 'İskeçe'
                })
            }
        }"
         x-init="load()"
         x-cloak
         x-show="temp"
         x-transition
    >
        <div class="d-flex align-items-center h-100">
            <div class="col-5">
                <div class="icon" x-html="icon"></div>
            </div>

            <div class="col">
                <div style="margin-top: -5px">
                    <div class="lh-sm fs-5" x-html="temp" style="font-weight: 500"></div>
                    <div class="small lh-sm" x-text="summary"></div>
                    <div class="small lh-sm" x-text="city"></div>
                </div>
            </div>
        </div>
    </div>
</div>
