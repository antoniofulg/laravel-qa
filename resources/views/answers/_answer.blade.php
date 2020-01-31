<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        @include('shared._vote', [
            'model' => $answer
        ])
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea v-model="body" rows="10" class="form-control" required>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-success" :disabled="isInvalid">Update</button>
                <button @click="cancel" type="button" class="btn btn-sm btn-outline-secondary">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can ('update', $answer)
                                <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
                            @can ('delete', $answer)
                                <button @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        <user-info :model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div>
            </div>                      
        </div>
    </div>
</answer>