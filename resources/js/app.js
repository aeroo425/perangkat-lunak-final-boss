import React, { useState, useEffect } from 'react';
import '@/App.css';
import { BrowserRouter, Routes, Route, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';

const BACKEND_URL = process.env.REACT_APP_BACKEND_URL;
const API = `${BACKEND_URL}/api`;

// Navbar Component
const Navbar = ({ currentPage }) => {
  return (
    <nav className="navbar-custom">
      <div className="navbar-container">
        <div className="navbar-brand">
          <img src="/Frame 1.png" alt="Logo" className="logo-img" />
          <h4 className="navbar-title">LOST AND FOUND</h4>
        </div>

        <div className="navbar-menu">
          <Link to="/" className={`menu-link ${currentPage === 'home' ? 'active' : ''}`}>Home</Link>
          <Link to="/list-item" className={`menu-link ${currentPage === 'list-item' ? 'active' : ''}`}>List Item</Link>
          <Link to="/my-report" className={`menu-link ${currentPage === 'my-report' ? 'active' : ''}`}>My Report</Link>
        </div>

        <div className="navbar-profile">
          <img src="/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.webp" alt="Profile" className="profile-img" />
        </div>
      </div>
    </nav>
  );
};

// Home Page
const Home = () => {
  const [stats, setStats] = useState({ total: 0, hilang: 0, ditemukan: 0 });
  const [recentItems, setRecentItems] = useState([]);

  useEffect(() => {
    fetchStats();
    fetchRecentItems();
  }, []);

  const fetchStats = async () => {
    try {
      const response = await axios.get(`${API}/stats`);
      setStats(response.data);
    } catch (error) {
      console.error('Error fetching stats:', error);
    }
  };

  const fetchRecentItems = async () => {
    try {
      const response = await axios.get(`${API}/items`);
      setRecentItems(response.data.slice(0, 2));
    } catch (error) {
      console.error('Error fetching items:', error);
    }
  };

  return (
    <div className="page-container">
      <Navbar currentPage="home" />

      <div className="content-wrapper">
        <div className="stats-container">
          <div className="stat-card">
            <div className="stat-icon lost-icon">📦</div>
            <h3>Lost Item</h3>
            <div className="stat-number">{stats.hilang}</div>
          </div>

          <div className="stat-card">
            <div className="stat-icon found-icon">🔍</div>
            <h3>Found Item</h3>
            <div className="stat-number">{stats.ditemukan}</div>
          </div>

          <div className="stat-card">
            <div className="stat-icon claim-icon">🤝</div>
            <h3>Claim Item</h3>
            <div className="stat-number">10</div>
          </div>
        </div>

        <div className="recent-section">
          <div className="section-header">
            <h2>LIST ITEM</h2>
            <div className="filter-buttons">
              <button className="filter-btn active">Barang Hilang</button>
              <button className="filter-btn">Barang Ditemukan</button>
            </div>
          </div>

          <div className="items-list">
            {recentItems.map((item) => (
              <div key={item.id} className="item-card">
                <div className="item-image">
                  {item.foto ? (
                    <img src={item.foto} alt={item.judul} />
                  ) : (
                    <div className="item-image-placeholder">📷</div>
                  )}
                </div>

                <div className="item-details">
                  <h3>{item.judul}</h3>
                  <p>Kategori: Barang Berharga</p>
                  <p>Lokasi Hilang: {item.lokasi}</p>
                  <p>Tanggal: {new Date(item.tanggal).toLocaleDateString('id-ID')}</p>
                </div>

                <div className="item-actions">
                  <div className={`status-badge ${item.status === 'hilang' ? 'status-lost' : 'status-found'}`}>
                    <span className="status-dot"></span>
                    {item.status === 'hilang' ? 'HILANG' : 'DITEMUKAN'}
                  </div>
                  <Link to={`/item/${item.id}`} className="detail-btn">Lihat Detail</Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

// List Item Page
const ListItem = () => {
  const [items, setItems] = useState([]);
  const [searchTerm, setSearchTerm] = useState('');
  const [filterStatus, setFilterStatus] = useState('');

  useEffect(() => {
    fetchItems();
  }, [filterStatus, searchTerm]);

  const fetchItems = async () => {
    try {
      let url = `${API}/items`;
      const params = [];

      if (filterStatus) params.push(`status=${filterStatus}`);
      if (searchTerm) params.push(`search=${searchTerm}`);

      if (params.length > 0) {
        url += `?${params.join('&')}`;
      }

      const response = await axios.get(url);
      setItems(response.data);
    } catch (error) {
      console.error('Error fetching items:', error);
    }
  };

  const handleSearch = (e) => {
    e.preventDefault();
    fetchItems();
  };

  return (
    <div className="page-container">
      <Navbar currentPage="list-item" />

      <div className="content-wrapper">
        <div className="list-header">
          <h2>LIST ITEM</h2>

          <div className="list-controls">
            <form onSubmit={handleSearch} className="search-form">
              <input
                type="text"
                placeholder="Cari Barang..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="search-input"
              />
              <button type="submit" className="search-btn">🔍</button>
            </form>

            <div className="filter-buttons">
              <button
                className={`filter-btn ${filterStatus === 'hilang' ? 'active' : ''}`}
                onClick={() => setFilterStatus(filterStatus === 'hilang' ? '' : 'hilang')}
              >
                Barang Hilang
              </button>
              <button
                className={`filter-btn ${filterStatus === 'ditemukan' ? 'active' : ''}`}
                onClick={() => setFilterStatus(filterStatus === 'ditemukan' ? '' : 'ditemukan')}
              >
                Barang Ditemukan
              </button>
            </div>
          </div>
        </div>

        <div className="items-list">
          {items.length > 0 ? (
            items.map((item) => (
              <div key={item.id} className="item-card">
                <div className="item-image">
                  {item.foto ? (
                    <img src={item.foto} alt={item.judul} />
                  ) : (
                    <div className="item-image-placeholder">📷</div>
                  )}
                </div>

                <div className="item-details">
                  <h3>{item.judul}</h3>
                  <p>📍 Lokasi: {item.lokasi}</p>
                  <p>📅 Tanggal: {new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</p>
                  <p>👤 Dilaporkan oleh: {item.user_name}</p>
                </div>

                <div className="item-actions">
                  <div className={`status-badge ${item.status === 'hilang' ? 'status-lost' : 'status-found'}`}>
                    <span className="status-dot"></span>
                    {item.status === 'hilang' ? 'HILANG' : 'DITEMUKAN'}
                  </div>
                  <Link to={`/item/${item.id}`} className="detail-btn">Lihat Detail</Link>
                </div>
              </div>
            ))
          ) : (
            <div className="empty-state">
              <p>📭 Tidak ada item ditemukan</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

// My Report Page
const MyReport = () => {
  const [myItems, setMyItems] = useState([]);
  const [showForm, setShowForm] = useState(false);
  const [formType, setFormType] = useState(''); // 'hilang' or 'ditemukan'
  const [filterStatus, setFilterStatus] = useState('');

  // Mock user data - in real app, get from auth context
  const currentUser = {
    email: 'user@example.com',
    name: 'User Demo'
  };

  useEffect(() => {
    fetchMyItems();
  }, [filterStatus]);

  const fetchMyItems = async () => {
    try {
      const response = await axios.get(`${API}/items/user/${currentUser.email}`);
      let items = response.data;

      if (filterStatus) {
        items = items.filter(item => item.status === filterStatus);
      }

      setMyItems(items);
    } catch (error) {
      console.error('Error fetching my items:', error);
    }
  };

  const handleCreateReport = (type) => {
    setFormType(type);
    setShowForm(true);
  };

  return (
    <div className="page-container">
      <Navbar currentPage="my-report" />

      <div className="content-wrapper">
        {!showForm ? (
          <>
            <div className="my-report-header">
              <h2>MY REPORT</h2>

              <div className="create-buttons">
                <button
                  className="create-btn create-lost"
                  onClick={() => handleCreateReport('hilang')}
                >
                  ➕ Laporkan Barang Hilang
                </button>
                <button
                  className="create-btn create-found"
                  onClick={() => handleCreateReport('ditemukan')}
                >
                  ➕ Laporkan Barang Ditemukan
                </button>
              </div>
            </div>

            <div className="filter-section">
              <div className="filter-buttons">
                <button
                  className={`filter-btn ${filterStatus === '' ? 'active' : ''}`}
                  onClick={() => setFilterStatus('')}
                >
                  Semua Laporan
                </button>
                <button
                  className={`filter-btn ${filterStatus === 'hilang' ? 'active' : ''}`}
                  onClick={() => setFilterStatus('hilang')}
                >
                  Laporan Kehilangan
                </button>
                <button
                  className={`filter-btn ${filterStatus === 'ditemukan' ? 'active' : ''}`}
                  onClick={() => setFilterStatus('ditemukan')}
                >
                  Laporan Penemuan
                </button>
              </div>
            </div>

            <div className="items-list">
              {myItems.length > 0 ? (
                myItems.map((item) => (
                  <div key={item.id} className="item-card">
                    <div className="item-image">
                      {item.foto ? (
                        <img src={item.foto} alt={item.judul} />
                      ) : (
                        <div className="item-image-placeholder">📷</div>
                      )}
                    </div>

                    <div className="item-details">
                      <h3>{item.judul}</h3>
                      <p>📍 Lokasi: {item.lokasi}</p>
                      <p>📅 Tanggal: {new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</p>
                    </div>

                    <div className="item-actions">
                      <div className={`status-badge ${item.status === 'hilang' ? 'status-lost' : 'status-found'}`}>
                        <span className="status-dot"></span>
                        {item.status === 'hilang' ? 'HILANG' : 'DITEMUKAN'}
                      </div>
                      <Link to={`/item/${item.id}`} className="detail-btn">Lihat Detail</Link>
                    </div>
                  </div>
                ))
              ) : (
                <div className="empty-state">
                  <p>📭 Belum ada laporan</p>
                </div>
              )}
            </div>
          </>
        ) : (
          <ReportForm
            type={formType}
            onClose={() => setShowForm(false)}
            onSuccess={() => {
              setShowForm(false);
              fetchMyItems();
            }}
            currentUser={currentUser}
          />
        )}
      </div>
    </div>
  );
};

// Report Form Component
const ReportForm = ({ type, onClose, onSuccess, currentUser }) => {
  const [formData, setFormData] = useState({
    judul: '',
    deskripsi: '',
    lokasi: '',
    tanggal: '',
    foto: ''
  });

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onloadend = () => {
        setFormData({
          ...formData,
          foto: reader.result
        });
      };
      reader.readAsDataURL(file);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      await axios.post(`${API}/items`, {
        ...formData,
        status: type,
        user_name: currentUser.name,
        user_email: currentUser.email
      });

      alert('Laporan berhasil dibuat!');
      onSuccess();
    } catch (error) {
      console.error('Error creating report:', error);
      alert('Gagal membuat laporan');
    }
  };

  return (
    <div className="form-container">
      <h2 className={type === 'hilang' ? 'text-danger' : 'text-success'}>
        {type === 'hilang' ? 'Laporkan Barang Hilang' : 'Laporkan Barang Ditemukan'}
      </h2>

      <form onSubmit={handleSubmit} className="report-form">
        <div className="form-group">
          <label>Judul Barang <span className="required">*</span></label>
          <input
            type="text"
            name="judul"
            value={formData.judul}
            onChange={handleChange}
            placeholder="Contoh: Tas Ransel Hitam"
            required
            className="form-input"
          />
        </div>

        <div className="form-group">
          <label>Deskripsi <span className="required">*</span></label>
          <textarea
            name="deskripsi"
            value={formData.deskripsi}
            onChange={handleChange}
            placeholder="Jelaskan ciri-ciri barang..."
            rows="4"
            required
            className="form-input"
          />
        </div>

        <div className="form-row">
          <div className="form-group">
            <label>Lokasi {type === 'hilang' ? 'Hilang' : 'Ditemukan'} <span className="required">*</span></label>
            <input
              type="text"
              name="lokasi"
              value={formData.lokasi}
              onChange={handleChange}
              placeholder="Contoh: Kantin Lantai 2"
              required
              className="form-input"
            />
          </div>

          <div className="form-group">
            <label>Tanggal {type === 'hilang' ? 'Hilang' : 'Ditemukan'} <span className="required">*</span></label>
            <input
              type="date"
              name="tanggal"
              value={formData.tanggal}
              onChange={handleChange}
              required
              className="form-input"
            />
          </div>
        </div>

        <div className="form-group">
          <label>Foto Barang (Opsional)</label>
          <input
            type="file"
            accept="image/*"
            onChange={handleFileChange}
            className="form-input"
          />
          <small>Format: JPG, PNG, WEBP (Maks. 2MB)</small>
        </div>

        <div className="form-actions">
          <button type="submit" className="submit-btn">✉️ Kirim Laporan</button>
          <button type="button" onClick={onClose} className="back-btn">← Kembali</button>
        </div>
      </form>
    </div>
  );
};

// Item Detail Page
const ItemDetail = () => {
  const [item, setItem] = useState(null);
  const navigate = useNavigate();
  const itemId = window.location.pathname.split('/').pop();

  useEffect(() => {
    fetchItemDetail();
  }, [itemId]);

  const fetchItemDetail = async () => {
    try {
      const response = await axios.get(`${API}/items/${itemId}`);
      setItem(response.data);
    } catch (error) {
      console.error('Error fetching item detail:', error);
    }
  };

  if (!item) {
    return <div>Loading...</div>;
  }

  return (
    <div className="page-container">
      <Navbar currentPage="" />

      <div className="content-wrapper">
        <div className="detail-container">
          <div className="detail-left">
            <h2>DETAIL BARANG</h2>

            <div className="detail-images">
              {item.foto ? (
                <img src={item.foto} alt={item.judul} className="detail-image" />
              ) : (
                <div className="detail-image-placeholder">📷</div>
              )}
            </div>

            <div className="detail-info">
              <h3>NAMA BARANG:</h3>
              <p>{item.judul}</p>

              <h3>KATEGORI:</h3>
              <p>Barang Berharga</p>
            </div>

            <div className="reporter-info">
              <h3>INFORMASI PELAPOR</h3>
              <p>{item.user_name}</p>
              <p>{item.user_email}</p>
              <p>{new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</p>
            </div>
          </div>

          <div className="detail-right">
            <h2>DESKRIPSI BARANG</h2>
            <p>{item.deskripsi}</p>

            <h3>LOKASI</h3>
            <p>{item.lokasi}</p>

            <div className={`status-badge-large ${item.status === 'hilang' ? 'status-lost' : 'status-found'}`}>
              <span className="status-dot"></span>
              {item.status === 'hilang' ? 'HILANG' : 'DITEMUKAN'}
            </div>

            <button className="claim-btn">Klaim Barang</button>
          </div>
        </div>

        <button onClick={() => navigate(-1)} className="back-btn mt-4">← Kembali</button>
      </div>
    </div>
  );
};

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/list-item" element={<ListItem />} />
          <Route path="/my-report" element={<MyReport />} />
          <Route path="/item/:id" element={<ItemDetail />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;
