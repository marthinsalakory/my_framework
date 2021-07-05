Aplikasi FrameWork yang dikembangkan dari konsep Objek Oriented Programing.

Aplikasi ini lengkap dengan fungsi Model, View, dan Controller.
Dari sisi aplikasinya juga dilengkapi dengan routing URL, yang dimana parameter pertama setelah nama aplikasi berupa Controller, parameter kedua berupa method, dan parameter ketiga berupa parameter pengirim.
Untuk mengamankan aplikasi ini pun, sudah dilengkapi dengan manipulasi routes, yang bisa di dapati di folder app/core/Routes.php.

/\*\*

- ***
- Routes
- app/core/Routes.php.
- ***
  \*/
  Dimenu class ini anda dapat mengatur

Defauld Controller dengan fungsi berikut : $routes->setDefauldController();
yang dimana menerima 1 parameter yang berisi nama controller defauld, contoh $routes->setDefauldController('Dashboard');

Defauld Method dengan fungsi berikut : $routes->setDefauldMethod();
yang dimana menerima 1 parameter yang berisi nama Method defauld, contoh $routes->setDefauldDefauld('index');

Routing otomatis, yang dimana akan menentukan Controller, dan method secara otomatis, lewat parameter di Url, yang fungsinya sebagai berikut $routes->setAutoRoute();
fungsi routes ini menerima 1 parameter berupa boolean true, atau false
Boolean true dengan penulisan sebagai berikut $routes->setAutoRoute(true); yang dmana anda mengijinkan routesnya berjalan secara otomatis.
Boolean false dengan penulisan sebagai berikut $routes->setAutoRoute(false); yang dimana anda tidak mengijinkan routesnya berjalan secara otomatis.

Manipulasi Routes, berdarkan apa yang dituliskan di URL, yang fugnsinya sebagai berikut $routes->get();
fungsi ini menerima 2 parameter, yang dimana parameter pertama adalah apa yang dituliskan di URL, dan parameter kedua berupa Controller dan method yang akan dituju.
contoh penulisannya sebagai berikut $routes->get('Login', 'Auth::index'); artinya anda setiap anda memanggil url login, maka akan diarahkan ke Controller Auth, Method index

/\*\*

- ***
- Controller
- app/controllers/.
- ***
  \*/
  Dimenu ini anda dapat mengatur seluruh aplkasi kamu.

Penulisan Controller ini sebagai berikut:

class Dashboard extends Controller
{
public function index()
{
echo "Hello World";
}
}

yang dimana controller ini akan extends ke file controller di folder app/core.
controller ini dapat digunakan seperti controller pada umum-nya.

/\*\*

- ***
- Model
- app/models/.
- ***
  \*/
  pada menu ini anda dapat mengatur seluruh konfigurasi pada database anda
  cara penulisannya sebagai berikut:

class homeModel
{
public function getall()
{
return 'ini fungsi model';
}
}

untuk cara pemanggilan model ini adalah dengan cara memasukan $this->homeModel = $this->model('homeModel') method \_\_construct pada controller.

pada model ini juga disediakkan fungsi mudah yang dimana pengguna dapat membuat CRUD dengan fungsi-fungsi yang telah dibuatkan di app/core/model.php.
untuk cara penggunaannya cukup simpel dengan membuat class model anda extends ke class Model.
cara penulisannya sebagai berikut:

class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall()
    {
        return 'ini model';
    }

}

dengan penulisan seperti ini berarti anda sudah terhubung dengan fungsi di class model.
didalam fungsi itu tersedia properti table, primaryKey, dan allowedFields.

protected $table berisi string nama tabel anda.
protected $primaryKey berisi string nama primaryKey pada tabel anda.
protected $allowedFields berisi Array dari apasaja yang anda ijinkan untuk insert atau updated data ke database, contoh arraynya ['id','nama', 'umur'];

pada fungsi model ini terdapat fungsi insert data ke database, yang dapat diakses dengan penulisan seperti berikut:

class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->save([
          'id' => 12,
          'nama' => 'Marthin',
          'umur' => '20 tahun'
        ]);
    }

}
yang dimana fungi ini menerima array dengan key-nya berupa nama apa yang akan di insert ke databasenya, dan valuenya berisi data yang akan di insert.

pada fungsi model ini terdapat juga fungsi update yang dapat diakses dengan penulisan seperti berikut:

class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->save('$id', [
          'id' => 12,
          'nama' => 'Marthin',
          'umur' => '20 tahun'
        ]);
    }

}
yang dimana fungsi ini menerima 2 parameter yang parameter pertamannya berupa value dari primaryKey, dan parameter kedu berupa apa yang akan ubah di database, semuanya sama dengan insert data.

pada fungsi ini terdapat juga fungsi delete dengan penulisan seperti berikut
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->delete('$id');
    }

}
yang dimana fungsi ini menerima 1 parameter berupa value dari primaryKey yang ingin dihapus.

pada fungsi ini juga terdapat fungsi findAll atau menampilkan semua data yang penulisannya sebagai berikut:
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->findAll();
    }

}
fungsi ini tidak menerima parameter apapun, namun mengembalikan data dari properti table yang sudah anda difinisikan.

pada class ini juga dapat menampilkan 1 data dari tabel, yang dapat diakses dengan fungsi first, yang penulisannya sebagai berikut:
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->first();
    }

}
yang dimana fungsi first ini tidak menerima parameter apapun, namun mengembalikan hasil 1 data pertama dari seluruh data tabel anda.

pada class ini juga terdapat fungsi where() yang berfungsi untuk membuat where data apa yang ingin ditampilkan, yang penulisannya sebagai berikut.
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->where([
          'id' => '21',
          'nama' => 'marthin'
        ])->first();
    }

}
fungsi ini menerima array yang berisi key dan value dari data yang ingin anda batasi, fungsi ini dapat dikombinasikan dengan fungsi first() ataupun findAll() untuk mnampilkan data.

pada class model ini juga terdapat fungsi select(), yang menerima paramete apa yang akan anda select untuk ditampilkan. cara penulisannya sebagai berikut:
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->select('id, nama, umur')->findAll;
    }

}
fungsi ini menerima 1 parameter berupa apa yang ingin di select, dan kemudian untuk menampilkannya bisa di ikuti dengan fungsi findAll, ataupun first untuk menampilkan data.

pada class Model ini juga terdapat fungsi join yang bisa dikombinasikan dengan fungsi yang lain. yang cara penulisannya sebagai berikut:
class homeModel extends Model
{
protected $table = 'users';
protected $primaryKey = 'id';
protected $allowedFields = [];

    public function getall($data)
    {
        $this->join('auth_group_users a', 'a.user_id = users.id')->findAll();
    }

}
fungsi ini menerima 2 parameter yang dimana parameter pertamannya berisi nama tabel yang ingin di join dan tabel keduannya berisi ketentuan join anda, yang bisa dikombinasikan dengan fungsi findAll() untuk menampilkan data.

/\*\*

- ***
- Views
- app/views/.
- ***
  \*/
  fungsi ini dapat diakses dengan pemanggilan dari controller, yaitu dengan cara memanggil fungsi $this->view();
  yang dimana fungsi view() ini menerima 1 parameter berupa arah ke view anda, contoh penulisan $this->view('home/index');
  artinya anda memanggil file index pada halaman app/views/home/index.

/\*\*

- ***
- Fungsi lain
- ***
  \*/
  untuk membuat fungsi yang lain anda dapat membuat class baru pada folder app/core yang akan dipanggil secara otomatis, dan anda hanya perlu menuliskan new class nya.
