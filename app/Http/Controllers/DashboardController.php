<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use App\Models\Pengguna;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Dashboard.dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.loginMahasiswa');
    }

    public function member()
    {
        $pengguna = Pengguna::whereIn('role', ['Koor UPT', 'PIC Lab', 'Admin Lab 1', 'Admin Lab 2'])
        ->where('status', 'Aktif')
        ->get();
        
        return view('member.index', ['pengguna' => $pengguna]);
    }

    public function ruangan()
    {       
        $ruangan = Ruangan::where('status', 'Tersedia')->get();
        return view('peminjamanRuangan.index',['ruangan'=>$ruangan]);
        
    }

    public function detail($id)
    {       
        $ruangan = Ruangan::findOrFail($id);
        
        // Pastikan variabel $ruangan bukan boolean (false)
        if (!$ruangan instanceof Ruangan) {
            // Lakukan penanganan kesalahan di sini, misalnya:
            return redirect()->route('route_name')->with('error', 'Ruangan tidak ditemukan');
        }

        $fasilitasDetail = $this->getFasilitasDetail($id);
    
        return view('peminjamanRuangan.detail', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail]);
    }
    
    public function getFasilitasDetail($id)
    {
        $fasilitasDetail = DB::table('fasilitas as a')
            ->join('fasilitas_ruangan as b', 'a.fasilitas_id', '=', 'b.fasilitas_id')
            ->select('b.*', 'a.nama_fasilitas', 'a.foto_fasilitas')
            ->where('b.ruangan_id', $id)
            ->get();

        return $fasilitasDetail;
    }

    public function barang()
    {
        $barang = Barang::where('status', 'Tersedia')->get();
        return view('peminjamanBarang.index', ['barang' => $barang]);
    }
    

    public function beranda(Request $request)
    {
        $condition = $request->input('condition', 'Pengajuan'); // Default condition is 'Pengajuan'
        
        $ruanganData = Ruangan::where('status', 'Tersedia')->count();
        $barangData = Barang::where('status', 'Tersedia')->count(); 
    
        if ($condition === 'Pengajuan' || $condition === 'Selesai' || $condition === 'Dipinjam' || $condition === 'Disetujui' || $condition === 'Ditolak') {
            $peminjamanruanganData = PeminjamanRuangan::where('status', $condition)->count();
            $peminjamanbarangData = PeminjamanBarang::where('status', $condition)->count();
        } else {
            $peminjamanruanganData = PeminjamanRuangan::count();
            $peminjamanbarangData = PeminjamanBarang::count();
        }
        
        $chartRuangan = $this->ChartRuangan(); // Assuming this function returns the correct data
        $chartBarang = $this->ChartBarang(); // Assuming this function returns the correct data
        $pieChart = $this->PieChart(); // Assuming this function returns the correct data
    
        // Retrieve other necessary data...
    
        return view('Dashboard.beranda', compact('ruanganData', 'barangData', 'chartRuangan', 'chartBarang', 'pieChart', 'peminjamanruanganData', 'peminjamanbarangData', 'condition'));
    }
    
    
    public function ChartRuangan()
    {
        // Define the months
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Retrieve Peminjaman Ruangan data
        $peminjamanRuanganData = PeminjamanRuangan::select(DB::raw('MONTH(tanggal_pinjam) as month'), 'ruangan_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('month', 'ruangan_id')
            ->get();

        // Define the ruangans
        $ruanganNames = Ruangan::pluck('nama_ruangan', 'ruangan_id')->toArray();

        // Initialize an array to store the chart data
        $chartData = [
            'labelbulan' => $months,
            'namaruangan' => array_values($ruanganNames),
            'datajumlah' => [],
        ];

        // Create a copy of $months for use within the anonymous function
        $monthsCopy = $months;

        // Populate the data array based on the retrieved Peminjaman Ruangan data
        foreach ($ruanganNames as $ruanganId => $ruanganName) {
            $jumlahData = [];
            foreach ($months as $month) {
                $data = $peminjamanRuanganData->first(function ($item) use ($month, $ruanganId, $monthsCopy) {
                    return $item->month == array_search($month, $monthsCopy) + 1 && $item->ruangan_id == $ruanganId;
                });

                $jumlahData[] = $data ? $data->jumlah : 0;
            }

            $chartData['datajumlah'][] = $jumlahData;
        }

        return json_encode($chartData);
    }

    

    public function ChartBarang()
    {
        // Implement your logic to retrieve Barang chart data
        // Example:
        $chartData = [
            'bulan' => ['January', 'February', 'March'],
            'barang' => ['Item A', 'Item B', 'Item C'],
            'jumlah' => [5, 10, 15],
        ];

        return json_encode($chartData);
    }

    public function PieChart()
    {
        // Implement your logic to retrieve Pie chart data
        // Example:
        $chartData = [
            'Pagi' => 30,
            'Malam' => 20,
        ];

        return json_encode($chartData);
    }


}
