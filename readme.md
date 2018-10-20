Retrieving All Models

`$users = User::all();`
Retrieving A Record By Primary Key

`$user = User::find('517c43667db388101e00000f');`
Wheres

`$users = User::where('votes', '>', 100)->take(10)->get();`
Or Statements

`$users = User::where('votes', '>', 100)->orWhere('name', 'John')->get();`
And Statements

`$users = User::where('votes', '>', 100)->where('name', '=', 'John')->get();`
Using Where In With An Array

`$users = User::whereIn('age', [16, 18, 20])->get();`
When using whereNotIn objects will be returned if the field is non existent. Combine with whereNotNull('age') to leave out those documents.

Using Where Between

`$users = User::whereBetween('votes', [1, 100])->get();`
Where null

`$users = User::whereNull('updated_at')->get();`
Order By

`$users = User::orderBy('name', 'desc')->get();`
Offset & Limit

`$users = User::skip(10)->take(5)->get();`
Distinct

Distinct requires a field for which to return the distinct values.

`$users = User::distinct()->get(['name']);`
// or
`$users = User::distinct('name')->get();`
Distinct can be combined with where:

`$users = User::where('active', true)->distinct('name')->get();`
Advanced Wheres

`$users = User::where('name', '=', 'John')->orWhere(function($query)
    {
        $query->where('votes', '>', 100)
              ->where('title', '<>', 'Admin');
    })
    ->get();`
Group By

Selected columns that are not grouped will be aggregated with the $last function.

`$users = Users::groupBy('title')->get(['title', 'name']);`
Aggregation

Aggregations are only available for MongoDB versions greater than 2.2.
`
$total = Order::count();`
`$price = Order::max('price');`
`$price = Order::min('price');`
`$price = Order::avg('price');`
`$total = Order::sum('price');`
`
Aggregations can be combined with where:

`$sold = Orders::where('sold', true)->sum('price');`
Aggregations can be also used on subdocuments:

`$total = Order::max('suborder.price');`
...
NOTE: this aggreagtion only works with single subdocuments (like embedsOne) not subdocument arrays (like embedsMany)

Like

`$user = Comment::where('body', 'like', '%spam%')->get();`
Incrementing or decrementing a value of a column

Perform increments or decrements (default 1) on specified attributes:

`User::where('name', 'John Doe')->increment('age');`
`User::where('name', 'Jaques')->decrement('weight', 50);`
The number of updated objects is returned:

`$count = User->increment('age');`
You may also specify additional columns to update:

`User::where('age', '29')->increment('age', 1, ['group' => 'thirty something']);`
`User::where('bmi', 30)->decrement('bmi', 1, ['category' => 'overweight']);`
Soft deleting

When soft deleting a model, it is not actually removed from your database. Instead, a deleted_at timestamp is set on the record. To enable soft deletes for a model, apply the SoftDeletingTrait to the model:

`use Jenssegers\Mongodb\Eloquent\SoftDeletes;`

class User extends Eloquent {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
For more information check http://laravel.com/docs/eloquent#soft-deleting

MongoDB specific operators
Exists

Matches documents that have the specified field.

`User::where('age', 'exists', true)->get();`
All

Matches arrays that contain all elements specified in the query.

`User::where('roles', 'all', ['moderator', 'author'])->get();`
Size

Selects documents if the array field is a specified size.

`User::where('tags', 'size', 3)->get();`
Regex

Selects documents where values match a specified regular expression.

`User::where('name', 'regex', new \MongoDB\BSON\Regex("/.*doe/i"))->get();`
NOTE: you can also use the Laravel regexp operations. These are a bit more flexible and will automatically convert your regular expression string to a MongoDB\BSON\Regex object.

`User::where('name', 'regexp', '/.*doe/i'))->get();`
And the inverse:

`User::where('name', 'not regexp', '/.*doe/i'))->get();`
Type

Selects documents if a field is of the specified type. For more information check: http://docs.mongodb.org/manual/reference/operator/query/type/#op._S_type

`User::where('age', 'type', 2)->get();`
Mod

Performs a modulo operation on the value of a field and selects documents with a specified result.

`User::where('age', 'mod', [10, 0])->get();`
Near

NOTE: Specify coordinates in this order: longitude, latitude.

`$users = User::where('location', 'near', [
	'$geometry' => [
        'type' => 'Point',
	    'coordinates' => [
	        -0.1367563,
            51.5100913,
        ],
    ],
    '$maxDistance' => 50,
]);`
GeoWithin

`$users = User::where('location', 'geoWithin', [
	'$geometry' => [
        'type' => 'Polygon',
	    'coordinates' => [[
            [
                -0.1450383,
                51.5069158,
            ],       
            [
                -0.1367563,
                51.5100913,
            ],       
            [
                -0.1270247,
                51.5013233,
            ],  
            [
                -0.1450383,
                51.5069158,
            ],
        ]],
    ],
]);`
GeoIntersects

`$locations = Location::where('location', 'geoIntersects', [
    '$geometry' => [
        'type' => 'LineString',
        'coordinates' => [
            [
                -0.144044,
                51.515215,
            ],
            [
                -0.129545,
                51.507864,
            ],
        ],
    ],
]);`
Where

Matches documents that satisfy a JavaScript expression. For more information check http://docs.mongodb.org/manual/reference/operator/query/where/#op._S_where

Inserts, updates and deletes
Inserting, updating and deleting records works just like the original Eloquent.

Saving a new model

`$user = new User;`

`$user->name = 'John';`

`$user->save();`

You may also use the create method to save a new model in a single line:

`User::create(['name' => 'John']);`

Updating a model

To update a model, you may retrieve it, change an attribute, and use the save method.

`$user = User::first();`

`$user->email = 'john@foo.com';`

`$user->save();`

There is also support for upsert operations, check https://github.com/jenssegers/laravel-mongodb#mongodb-specific-operations

Deleting a model

To delete a model, simply call the delete method on the instance:

`$user = User::first();`

`$user->delete();`

Or deleting a model by its key:

`User::destroy('517c43667db388101e00000f');`

For more information about model manipulation, check http://laravel.com/docs/eloquent#insert-update-delete

Dates
Eloquent allows you to work with Carbon/DateTime objects instead of MongoDate objects. Internally, these dates will be converted to MongoDate objects when saved to the database. If you wish to use this functionality on non-default date fields you will need to manually specify them as described here: http://laravel.com/docs/eloquent#date-mutators

Example:
`
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $dates = ['birthday'];

}`

Which allows you to execute queries like:

`$users = User::where('birthday', '>', new DateTime('-18 years'))->get();`

Relations
Supported relations are:
`
hasOne
hasMany
belongsTo
belongsToMany
embedsOne
embedsMany`

Example:


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function items()
    {
        return $this->hasMany('Item');
    }

}

And the inverse relation:

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent {

    public function user()
    {
        return $this->belongsTo('User');
    }

}
The belongsToMany relation will not use a pivot "table", but will push id's to a related_ids attribute instead. This makes the second parameter for the belongsToMany method useless. If you want to define custom keys for your relation, set it to null:

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function groups()
    {
        return $this->belongsToMany('Group', null, 'user_ids', 'group_ids');
    }

}
Other relations are not yet supported, but may be added in the future. Read more about these relations on http://laravel.com/docs/eloquent#relationships

EmbedsMany Relations
If you want to embed models, rather than referencing them, you can use the embedsMany relation. This relation is similar to the hasMany relation, but embeds the models inside the parent object.

REMEMBER: these relations return Eloquent collections, they don't return query builder objects!

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent {

    public function books()
    {
        return $this->embedsMany('Book');
    }

}
You access the embedded models through the dynamic property:

`$books = User::first()->books;`

The inverse relation is automagically available, you don't need to define this reverse relation.

`$user = $book->user;`

Inserting and updating embedded models works similar to the hasMany relation:

`$book = new Book(['title' => 'A Game of Thrones']);`

`$user = User::first();`

`$book = $user->books()->save($book);`

// or

`$book = $user->books()->create(['title' => 'A Game of Thrones'])`

You can update embedded models using their save method (available since release 2.0.0):

`$book = $user->books()->first();`


`$book->title = 'A Game of Thrones';`


`$book->save();`

You can remove an embedded model by using the destroy method on the relation, or the delete method on the model (available since release 2.0.0):

`$book = $user->books()->first();`

`$book->delete();`

// or

`$user->books()->destroy($book);`

If you want to add or remove an embedded model, without touching the database, you can use the associate and dissociate methods. To eventually write the changes to the database, save the parent object:

`$user->books()->associate($book);`

`$user->save();`

Like other relations, embedsMany assumes the local key of the relationship based on the model name. You can override the default local key by passing a second argument to the embedsMany method:

`return $this->embedsMany('Book', 'local_key');`

Embedded relations will return a Collection of embedded items instead of a query builder. Check out the available operations here: https://laravel.com/docs/master/collections

EmbedsOne Relations
The embedsOne relation is similar to the EmbedsMany relation, but only embeds a single model.

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent {

    public function author()
    {
        return $this->embedsOne('Author');
    }

}

You access the embedded models through the dynamic property:

`$author = Book::first()->author;`

Inserting and updating embedded models works similar to the hasOne relation:

`$author = new Author(['name' => 'John Doe']);`

`$book = Books::first();`

`$author = $book->author()->save($author);`

// or

`$author = $book->author()->create(['name' => 'John Doe']);`

You can update the embedded model using the save method (available since release 2.0.0):

`$author = $book->author;`


`$author->name = 'Jane Doe';`

`$author->save();`

You can replace the embedded model with a new model like this:

`$newAuthor = new Author(['name' => 'Jane Doe']);`

`$book->author()->save($newAuthor);`

MySQL Relations
If you're using a hybrid MongoDB and SQL setup, you're in luck! The model will automatically return a MongoDB- or SQL-relation based on the type of the related model. Of course, if you want this functionality to work both ways, your SQL-models will need use the Jenssegers\Mongodb\Eloquent\HybridRelations trait. Note that this functionality only works for hasOne, hasMany and belongsTo relations.

Example SQL-based User model:

use Jenssegers\Mongodb\Eloquent\HybridRelations;

class User extends Eloquent {

    use HybridRelations;

    protected $connection = 'mysql';

    public function messages()
    {
        return $this->hasMany('Message');
    }

}

And the Mongodb-based Message model:

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Message extends Eloquent {

    protected $connection = 'mongodb';

    public function user()
    {
        return $this->belongsTo('User');
    }

}

Raw Expressions
These expressions will be injected directly into the query.

`User::whereRaw(['age' => array('$gt' => 30, '$lt' => 40)])->get();`

You can also perform raw expressions on the internal MongoCollection object. If this is executed on the model class, it will return a collection of models. If this is executed on the query builder, it will return the original response.

// Returns a collection of User models.

`$models = User::raw(function($collection)
{
    return $collection->find();
});`

// Returns the original MongoCursor.
`$cursor = DB::collection('users')->raw(function($collection)
{
    return $collection->find();
});`

Optional: if you don't pass a closure to the raw method, the internal MongoCollection object will be accessible:

`$model = User::raw()->findOne(['age' => array('$lt' => 18)]);`

The internal MongoClient and MongoDB objects can be accessed like this:

`$client = DB::getMongoClient();`
`$db = DB::getMongoDB();`

MongoDB specific operations
Cursor timeout

To prevent MongoCursorTimeout exceptions, you can manually set a timeout value that will be applied to the cursor:

`DB::collection('users')->timeout(-1)->get();`

Upsert

Update or insert a document. Additional options for the update method are passed directly to the native update method.

`DB::collection('users')->where('name', 'John')
                       ->update($data, ['upsert' => true]);`
                       
Projections

You can apply projections to your queries using the project method.

`DB::collection('items')->project(['tags' => ['$slice' => 1]])->get();`

`DB::collection('items')->project(['tags' => ['$slice' => [3, 7]]])->get();`

Projections with Pagination

`$limit = 25;`
`$projections = ['id', 'name'];`
`DB::collection('items')->paginate($limit, $projections);`

Push

Add an items to an array.

`DB::collection('users')->where('name', 'John')->push('items', 'boots');`

`DB::collection('users')->where('name', 'John')->push('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);`

If you don't want duplicate items, set the third parameter to true:

`DB::collection('users')->where('name', 'John')->push('items', 'boots', true);`

Pull

Remove an item from an array.

`DB::collection('users')->where('name', 'John')->pull('items', 'boots');`

`DB::collection('users')->where('name', 'John')->pull('messages', ['from' => 'Jane Doe', 'message' => 'Hi John']);`

Unset

Remove one or more fields from a document.

`DB::collection('users')->where('name', 'John')->unset('note');`

You can also perform an unset on a model.

`$user = User::where('name', 'John')->first();`

`$user->unset('note');`

Query Caching
You may easily cache the results of a query using the remember method:

`$users = User::remember(10)->get();`

From: http://laravel.com/docs/queries#caching-queries

Query Logging
By default, Laravel keeps a log in memory of all queries that have been run for the current request. However, in some cases, such as when inserting a large number of rows, this can cause the application to use excess memory. To disable the log, you may use the disableQueryLog method:

`DB::connection()->disableQueryLog();`

From: http://laravel.com/docs/database#query-logging