
<!-- Task 1: Request Validation -->

    public function register(Request $request)
    {
      
        $rules = [
            'name' => 'required|string|min:2',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
           
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        return response()->json([
            'message' => 'Registration successful!',
        ], 200);
    }

<!-- Task 2: Request Redirect -->

Route::get('/home', function () {
    return Redirect::to('/dashboard', 302);
});

<!-- Task 3: Global Middleware -->

  public function handle($request, Closure $next)
    {
        Log::info('Request Method: ' . $request->method());
        Log::info('Request URL: ' . $request->fullUrl());

        return $next($request);
    }

<!-- Task 4: Route Middleware -->

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/settings', 'SettingsController@index')->name('settings');
});


<!-- Task 5: Controller -->

    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
           
        ]);

        $product = Product::create($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
           
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    
<!-- Task 6: Single Action Controller -->

 public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('your-email@example.com')->send(new ContactFormMail($validatedData));

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }


<!-- Task 7: Resource Controller -->

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::create($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validatedData);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

<!-- Task 8: Blade Template Engine -->


<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Laravel</title>
   
</head>
<body>
   
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
           
        </ul>
    </nav>

 
    <section>
        <h1>Welcome to Laravel!</h1>
      
    </section>

  
</body>
</html>



