<div id="queueUpdatesDiv" class="row justify-content-center" v-if="queueUpdates.length > 0">
	<div class="col-md-8">
		<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Ticket NO.</th>
                    <th scope="col">Clinic NO.</th>
                </tr>
            </thead>
            <tbody>
            	<tr v-for="update in queueUpdates">
            		<td class="align-middle" scope="row">
            			@{{ update.queue_no }}
            		</td>
            		<td class="align-middle">
            			@{{ update.clinic_no }}
            		</td>
            	</tr>
            </tbody>
        </table>
	</div>
</div>
<script>
    window.queueUpdates = @json($queueUpdates);
</script>