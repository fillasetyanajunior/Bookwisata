<form action="/chat" method="post">
  @csrf
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Pesan</label>
      
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="messages"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>