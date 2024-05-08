<h1>Devices</h1>

<ul>
    @foreach($devices as $device)
        <li>
            {{ $device->name }}
            <ul>
                @foreach($device->logs as $log)
                    <li>
                        {{ $log->log_data }} ({{ $log->log_time }})
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

<script>
    fetch('/api/devices')
       .then(response => response.json())
       .then(data => {
            const devicesHtml = data.map(device => {
                return `
                    <li>
                        ${device.name}
                        <ul>
                            ${device.logs.map(log => {
                                return `
                                    <li>
                                        ${log.log_data} (${log.log_time})
                                    </li>
                                `;
                            }).join('')}
                        </ul>
                    </li>
                `;
            }).join('');

            document.querySelector('ul').innerHTML = devicesHtml;
        });
</script>
