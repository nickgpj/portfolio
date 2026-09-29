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
    [Table("characters")]
    [Index(nameof(Name), nameof(GameId),
        IsUnique = true, Name = "UX_EindopdrachtCharacters")]
    public class Character : ObservableObject
    {
        #region fields
        private string _name = null!;
        private int _gameId = 0;
        private Game? _game;
        #endregion

        #region properties
        [Key]
        public int Id { get; set; }

        [StringLength(255), Required]
        public string Name 
        { 
            get { return _name; }
            set { _name = value; OnPropertyChanged(); }
        }

        [StringLength(255), Required, ForeignKey("GameId")]
        public int GameId
        {
            get { return _gameId; }
            set { _gameId = value; OnPropertyChanged(); }
        }

        [Required]
        public Game? Game
        {
            get { return _game; }
            set { _game = value; OnPropertyChanged(); }
        }

        #endregion

        #region constructors
        public Character()
        {
            Name = "";
            GameId = 0;
        }
        #endregion
    }
}
