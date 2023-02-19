<x-layout title="Reply Comment">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Reply comment</div>

                    <div class="card-body">
                        <x-form action="{{ route('comments.reply.store', $comment->id) }}">
                            <div class="mb-3">
                                <label class="form-label" for="file">Comment <small>from
                                    {{ '@'.$comment->user->username }}</small></label>
                                <div class="text-muted">
                                    {{ $comment->body }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Reply <small>to  {{ '@'.$comment->user->username }}</small></label>
                                <textarea name="body" rows="3" class="form-control @error('body')
                                    is-invalid
                                @enderror" autofocus=""></textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                       {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a href="index.html" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </x-form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
