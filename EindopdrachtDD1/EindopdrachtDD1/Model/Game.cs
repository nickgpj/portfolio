using EindopdrachtDD1.Helpers;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace EindopdrachtDD1.Model
{
    [Table("games")]
    [Index(nameof(Name), nameof(Genre), 
        IsUnique = true, Name = "UX_EindopdrachtGames")]
    public class Game : ObservableObject
    {
        #region fields
        private int _gameId = 0;
        private string _name = null!;
        private string _genre = null!;
        #endregion

        #region properties
        [Key]
        public int GameId { get; set; }

        public string Name
        {
            get { return _name; }
            set { _name = value; OnPropertyChanged(); }
        }

        public string Genre
        {
            get { return _genre; }
            set { _genre = value; OnPropertyChanged(); }
        }

        public virtual ICollection<Character> Characters { get; set; } = new List<Character>();
        #endregion

        #region constructors
        public Game()
        {
            Name = "";
            Genre = "";
        }
        #endregion
    }
}
